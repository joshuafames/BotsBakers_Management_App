import win32com.client as win32
import os
import sys

def convert_excel_to_pdf(excel_file_path, pdf_file_path):
    excel = win32.Dispatch('Excel.Application')
    excel.Visible = False
    
    wb = excel.Workbooks.Open(excel_file_path)
    wb.ExportAsFixedFormat(0, pdf_file_path)
    wb.Close()
    excel.Quit()
    print(f"Converted {excel_file_path} to {pdf_file_path}")

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python script.py <excel_file_path> <pdf_file_path>")
        sys.exit(1)
    
    current_directory = os.path.dirname(os.path.abspath(__file__))
    excel_file = os.path.join(current_directory, sys.argv[1])
    pdf_file = os.path.join(current_directory, sys.argv[2])

    convert_excel_to_pdf(excel_file, pdf_file)
