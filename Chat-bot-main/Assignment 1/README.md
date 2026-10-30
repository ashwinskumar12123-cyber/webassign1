# Simple Network Chat Application

A PHP + MySQL multi-user chat page. Messages are stored in a shared MySQL
database, so anyone who opens the page from another computer on the network
sees the same conversation.

## Features
- Single page: name box, message box, Send button
- Shows the latest 50 messages, oldest first, with timestamps
- Page auto-refreshes every 15 seconds
- Prepared statements (SQL injection safe) and `htmlspecialchars` (XSS safe)
- Post/Redirect/Get so a refresh never re-sends a message

## Files
| File | Purpose |
|------|---------|
| `index.php` | Chat page (save + display messages) |
| `db.php` | MySQL connection settings |
| `schema.sql` | Creates the database, table and DB user |
| `op.png` | Screenshot of the running app |

## Setup
1. Install PHP (with `mysqli`) and MySQL (XAMPP works on Windows).
2. Import the schema: `mysql -u root -p < schema.sql`
3. Edit `db.php` if your server address, user or password differ.
4. Put the folder in your web root (e.g. `htdocs/chat`) and open
   `http://<server-ip>/chat/index.php`.

## Security note
`db.php` contains a plain-text password. Use a strong password and do not
commit real credentials to a public repository.
