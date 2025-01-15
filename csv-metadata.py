import os
import csv
from datetime import datetime
from PIL import Image, ExifTags
from tkinter import Tk, filedialog, messagebox
from tkinter import ttk

# ฟังก์ชันแปลงรหัส EXIF เป็นชื่อ
def get_exif_name(hex_key):
    return ExifTags.TAGS.get(int(hex_key, 16), hex_key)

# ฟังก์ชันสร้าง Metadata
def generate_metadata(image_dir, category, selected_keys):
    if not os.path.exists(image_dir):
        print(f"Directory '{image_dir}' does not exist!")
        return

    folder_name = os.path.basename(image_dir)
    output_csv = f"{category}_{folder_name}_metadata.csv"

    count = 1
    while os.path.exists(output_csv):
        output_csv = f"{category}_{folder_name}_metadata_{count}.csv"
        count += 1

    # สร้างไฟล์ CSV
    with open(output_csv, mode="w", newline="", encoding="utf-8-sig") as file:
        writer = csv.writer(file)

        # สร้าง Header โดยเพิ่มข้อมูล Width และ Height
        header = ["filename", "filepath", "category", "width", "height" ,"DateTimeDigitized"] + [get_exif_name(key) for key in selected_keys]
        writer.writerow(header)

        # วนลูปไฟล์ในโฟลเดอร์
        for root, _, files in os.walk(image_dir):
            for file in files:
                if file.lower().endswith((".jpg", ".jpeg", ".png", ".gif")):
                    filepath = os.path.join(root, file)

                    with Image.open(filepath) as img:
                        # ดึงขนาดรูปภาพ (width, height)
                        width, height = img.size

                        # ดึงข้อมูล EXIF
                        exif_data = img._getexif()
                        exif_values = {}
                        if exif_data:
                            for key in selected_keys:
                                exif_values[key] = exif_data.get(int(key, 16), "Not Available")
                                # ดึง DateTimeDigitized (ถ้ามีใน EXIF)
                            datetime_digitized = exif_data.get(0x9004, "Not Available")
                        else:
                            exif_values = {key: "Not Available" for key in selected_keys}

                    # สร้างแถวข้อมูล
                    row = [file, f"images/{category}/{folder_name}/{file}", category, width, height, datetime_digitized] + [exif_values[key] for key in selected_keys]
                    writer.writerow(row)

    print(f"Metadata CSV has been created: {output_csv}")
    messagebox.showinfo("Success", f"Metadata CSV has been created: {output_csv}")

# ฟังก์ชันให้ผู้ใช้เลือกโฟลเดอร์
def choose_directory():
    root = Tk()
    root.withdraw()
    return filedialog.askdirectory(title="Select Folder with Images")

# ฟังก์ชันเลือก category และ keys
def choose_options():
    window = Tk()
    window.title("Choose Options")

    categories = ["Nature", "Urban", "Portrait", "Architecture", "Animals", "Other"]
    exif_keys = {
        "0x0110": "Model",
        "0x829A": "ExposureTime",
        "0x829D": "FNumber",
        "0x8827": "ISOSpeedRatings"
    }

    category_var = ttk.Combobox(window, values=categories)
    category_var.set(categories[0])
    ttk.Label(window, text="Select Image Category:").pack(padx=10, pady=5)
    category_var.pack(padx=10, pady=5)

    ttk.Label(window, text="Select EXIF Data to Extract:").pack(padx=10, pady=5)

    selected_keys = []

    def toggle_key(key):
        if key in selected_keys:
            selected_keys.remove(key)
        else:
            selected_keys.append(key)

    for hex_key, description in exif_keys.items():
        chk = ttk.Checkbutton(window, text=f"{description} ({hex_key})", \
                    command=lambda k=hex_key: toggle_key(k))
        chk.pack(anchor="w", padx=20)

    def on_ok_button_click():
        selected_category = category_var.get()
        window.quit()
        window.destroy()
        image_directory = choose_directory()
        if image_directory:
            generate_metadata(image_directory, selected_category, selected_keys)
        else:
            messagebox.showerror("Error", "No folder selected.")

    ttk.Button(window, text="OK", command=on_ok_button_click).pack(pady=20)
    window.mainloop()

# เรียกใช้งานฟังก์ชัน
choose_options()




#Column names ใส่ตอน import csv ใน phpMyAdmin
#filename, filepath, category, width, height, DateTimeDigitized, Model, ExposureTime, FNumber, ISOSpeedRatings