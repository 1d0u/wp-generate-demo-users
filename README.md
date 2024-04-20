# Muzip Demo User Generator

Muzip Demo User Generator is a WordPress plugin that allows administrators to quickly generate multiple demo user accounts based on a provided list of usernames.

## Features

- Generate multiple user accounts with one click.
- Specify usernames in a list within the admin page.
- Easy-to-use interface.
- Users are created with random passwords and email addresses that match the username.

  ## Installation

1. Download the plugin from the GitHub repository or clone it using git.
    ```
    git clone https://github.com/muzipp/wp-generate-demo-users.git
    ```
2. Upload the plugin files to the `/wp-content/plugins/muzip-demo-user-generator` directory.
3. Activate the plugin through the 'Plugins' screen in WordPress.

## Usage

1. After the plugin activation, a page called `Muzip Demo User Generator` is automatically created on your site.
2. Can start generating users by going to `yoursite.com/muzip-demo-user-generator/`
3. Enter the usernames you wish to create, one username per line.
4. Click the `Generate Users!` button to create the user accounts.

## Frequently Asked Questions

**Q: What happens if a username already exists?**
A: The plugin will skip existing usernames and only create accounts for the new usernames.

**Q: Are the generated accounts given a role?**
A: Yes, generated accounts are set with the default role specified in your WordPress settings.

**Q: Can I see the generated passwords?**
A: For security purposes, passwords are not displayed but you can set new password them from the WordPress user list.

## Changelog

### 1.0
- Initial release.

## Support

For support, please open an issue in the GitHub repository.

## License

The Muzip Demo User Generator is open-sourced software licensed under the [GPLv2 license](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html).
