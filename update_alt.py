import os, re

dir_path = r'C:\xampp\htdocs\delhitempotravelleronrent'
pattern = re.compile(r'<img class=\"hero-bg-img\" src=\"images/([^.]*?)\.png\" alt=\"<\?php echo htmlspecialchars\(strip_tags\(\$page_title\)\); \?>\">')

for filename in os.listdir(dir_path):
    if filename.endswith('.php'):
        filepath = os.path.join(dir_path, filename)
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
        
        def repl(match):
            img_name = match.group(1)
            # Remove -hero-bg or -bg or mehrangarh-
            clean_name = img_name.replace('-hero-bg', '').replace('-bg', '').replace('mehrangarh-', '')
            clean_name = clean_name.replace('-', ' ').title()
            return f'<img class="hero-bg-img" src="images/{img_name}.png" alt="{clean_name}">'
            
        new_content, count = pattern.subn(repl, content)
        if count > 0:
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print(f'Updated {filename}')
