# My Custom Hover Cards Widget for Elementor

This WordPress plugin adds a fully customizable **hover card widget** to Elementor. It allows you to display a heading, a list of items with optional links, and stylish hover animations with background images, overlay controls, and flexible responsive settings.

---

## 🔧 Features

- Two-line editable heading
- Repeater list with:
  - Customizable text
  - Optional URL (with target and nofollow support)
- Bullet styles:
  - Default circular bullet (with color and size control)
  - Custom SVG/image bullet
- Full background image control:
  - Image upload
  - Position, repeat, and size options
- Card design controls:
  - Width and height (responsive)
  - Padding and margin (responsive)
  - Overlay color for base and hover states
- Typography controls for the heading

---

## 📦 Installation

1. Copy the plugin folder into your `/wp-content/plugins/` directory.
2. Make sure the folder is named something like `my-custom-hover-cards-widget`.
3. Activate the plugin via the WordPress admin panel under **Plugins > Installed Plugins**.
4. Edit a page with Elementor.
5. Search for **“My Custom Hover Card Widget”** in the widget panel.
6. Drag it into your layout and start customizing.

---

## 🧩 Dependencies

- **Elementor Page Builder** (free version is sufficient)
- WordPress 5.0+

---

## 🛠 Development Notes

- Uses Elementor’s `Repeater`, `Responsive Controls`, and `Group_Control_Typography`.
- Uses inline CSS inside the `render()` method for dynamic styling (you can later extract this into an external CSS file if preferred).
- Follows WordPress and Elementor coding best practices.

---

## 📝 License

This plugin is open-source and free to use. Customize and adapt it as needed in your own projects.

---

## 🙋‍♂️ Author

Created by Yoni Silvestre
Contact: yonisantiagosg@gmail.com

---

