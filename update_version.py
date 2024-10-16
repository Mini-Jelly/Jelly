import re
from datetime import datetime

# 定义要更新的文件路径
file_path = 'index.php'

def update_version_number():
    # 获取当前日期并格式化为 6 位数的版本号
    version_number = datetime.now().strftime('%y%m%d')
    new_version = f'Beat {version_number}'

    # 定义正则表达式来匹配版本号
    pattern = r'Beat \d{6}'
    replacements = 0

    try:
        # 使用 UTF-8 编码打开文件并读取内容
        with open(file_path, 'r', encoding='utf-8') as file:
            content = file.readlines()

        # 更新文件内容
        for i, line in enumerate(content):
            if re.search(pattern, line):
                content[i] = re.sub(pattern, new_version, line)
                replacements += 1
                if replacements >= 2:  # 达到 2 次替换后停止
                    break

        # 如果有替换，写回文件
        if replacements > 0:
            with open(file_path, 'w', encoding='utf-8') as file:
                file.writelines(content)
            print(f"Updated {replacements} version numbers to {new_version}.")
        else:
            print("No version number to update found.")

    except FileNotFoundError:
        print(f"Error: {file_path} not found.")
    except Exception as e:
        print(f"An error occurred: {e}")

if __name__ == "__main__":
    update_version_number()