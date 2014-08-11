ezLeague 3.0 is currently in development and is slated to have a stable beta release by the end of August. progress updates will be posted on http://www.mdloring.com. this new version is being 100% re-written, and should be a massive improvement to the past version. thank you for all of the feedback and suggestions i have received since starting this project.

ezLeague v2.1
------------------------------------------------------------------------------------------------------------------------
"a custom php online gaming script"

(bug fixes listed at the bottom)

http://www.mdloring.com
demo: http://ezleague.mdloring.com

About ezLeague
------------------------------------------------------------------------------------------------------------------------

After writing 2-3 different PHP Gaming League scripts, I've received numerous emails over the past 6months asking to offer it up for download...but it wasn't exactly user friendly. So that's what ezLeague is.

Instead of having to build in a custom templating system, the front and backend are being built on Bootstrap to make theming easier for the user.

A full-list of features is soon to come. I'm still in debate on how to combine the 3 previous scripts I've written.

News, Leagues, Matches, Teams, Users, Site Settings, Support Multiple Games

Team/Guild Challenge System for Matches
Rankings will be built on an ELO algorithm, the same ranking system used for Chess Players ...more to be listed later

Admin Panel to control and modify all Leagues, Matches, Users and Data

How to Upgrade
------------------------------------------------------------------------------------------------------------------------
When a new version is released, unless you have made your own changes to specific files, simply re-download ezLeague, and overwrite all files/folders EXCEPT for /lib/db.class.php & /admin/lib/db.class.php.

If you overwrite the db.class.php files, you'll have to re-add your database configuration information.

If you run into any issues, please post them on the Issues page (https://github.com/stoopkid1/ezleague/issues) and I'll look into it.

------------------------------------------------------------------------------------------------------------------------
BUG FIXES AND UPDATES
------------------------------------------------------------------------------------------------------------------------
v2.1
- Basic Forum
- Admin Forum -- Add Sections, Disable/Enable Sections
- Site Logo
- Team Logo
- .htaccess file changes made to handle forum
- Make Challenge bug fixed where button would not display

v2.0
- User Inbox/Message System
- Prediction System for matches/challenges
- About Us page -- modified through the Admin Panel Site Settings
- Contact Us page -- modified through the Admin Panel Site Settings
- .htaccess file changes made to handle new pages
- re-wrote the installation and upgrade functions to utilize mysqli_multi_query()

v1.6
- Member Search added to Members page
- Team Invite functionality added with a confirmation popup
- Team Invites notification added to header

v1.5
- Various fixes to Leagues and corresponding functionality
- removed any remaining mentions of ELO
- Leave League and Join League functionality updated

v1.4
- ELO ranking system and corresponding columns have been removed (some functions still exist, as i plan to re-add this again later)
- NEW Point Ranking System implemented across all games and leagues
- standings page updated to reflect point ranking system implementation
- admins can now change the point values given per win/loss/tie dependent on the league
- match editing reflects the new point system update

v1.3
 - View & Create Admins – currently on GitHub
 - Create users
 - Update profile settings (password & email) – currently on GitHub
 - Site Settings link structure (all site settings file names have been changed) – currently on GitHub
 - List the total amount of teams per league
 - Kick team from league
 - Add “view matches” to the individual team profiles
 - Add team records to the individual team profiles
 - View League Profile
 - Edit League Rules

v1.2
 - forget/reset password option available for users -- ./reset.php, ./forget.php, ./lib/ezleague.class.php, ./js/ezleague.js, ./submit.php
 - update user settings (email & password) -- ./settings.php, ./js/ezleague.js, ./submit.php, ./lib/ezleague.js
 - user search/lookup for admins -- ./admin/users_all.php, ./admin/lib/ezleague.class.php
 - captcha code for registration -- ./footer.php, ./lib/ezleague.class.php, ./js/ezleague.js
 - settings page added to .htaccess -- .htaccess
 - registration/install functionality cleanup -- final fix applied to the registration and installation bugs.

v1.1
 - removed installation step #2 -- ./header.php, ./js/ezleague.js
 - fixed add news body text issue -- ./admin/js/ezleague.js, ./admin/submit.php, ./index.php, ./js/ezleague.js, ./news.php
 - login function double-prefix bug -- ./lib/ezleague.class.php
 - added dispute functionality -- ./index.php, ./view_challenge.php
 - display message if no news items found -- ./index.php, ./lib/ezleague.class.php
 - added a View Site link in the sidebar on the admin side -- /admin/sidebar.php
