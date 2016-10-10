
Missio:Another way to make e-commerce. The main file is ss_config.php. E.g. storage.php and showcase.php uses it.

About bugs / under construction: 

In common (ss_config.php, index.php, storage.php)
----------------------------------------------------
1. needs better account-management & email-registeration (ss_config.php, index.php)
2. less code / more effects in common
3. you may need use one time ctrl-f5 to refresh login/session (f.e. when you are in showcase.php orstorage.php -page after login)
4. Usability problems with exchanges above green panel, better location is under EXCHANGE (see storage.php) when some link is selected.
4.1 While timer goes to 0 or less, "time_end"-message, but no concretical things happens
5. Market system need fix in usability
6. "P"- & "N"-button has js-linker problem, search bar too, at Green bar on the top

Showcase.php
----------------------------------------------------
1. Better position for "New fashion", "Compatible stuff", "Wanted", "Upgrades" and "Updates" -links will be in left menu bar under favorites.
2. Needs SQL-algorithm to show content for default "new fashion"-view.
3. Empty cart & "Settings"-icon has own algorithm, mut it doesn't work (linker problem to javascript)
4. Rooms & Trade -header nees more effect on right menu bar.
5. Items under Upcoming Notices need more effects (old example for author)
6. Exchange -link is old (a model, but see storage.php stage 5.)

Storage.php
----------------------------------------------------
1. After Lisää kohde... -button (opens dialog)
1.1 need determine default Object type
1.2 better connector-adding system (in the bottom of)
1.3 must be at least 2 unit selected some connector after connector search, or it doesn't go to database
2. Under Inventaario is buttons, if enough connections. Idea is similar than navigation, as you can navigate [Property] > [Home] > [Room] > [Stuff] > [Sub-Stuff] etc.
3. While add object, make some connections. E.g. lattia (male) for stuff, and lattia (female) for room, and nest (female) for house, and nest (male) for room. base (male) for house and base (female) for property. It seems like better if they will be automatic, and other connections users can make manually.
4. You will see the level where is "Stuff tree | Independent Compilations | Independent stuffs"
4.1 Independent compilations & independent stuffs needs fix, not correct content
4.2 It's good thing to show count of content behind title
5. Catalog Dialog open after click "Upgraded a moment ago (5 new upgrades)"
5.1 What's New - menu needs more interaction as dialog can load content and sort them by logical groups, which are compatible with parent product, e.g. Cell room.
5.2 Links are useless near "What's New" - menu, and "Connection"-button in top of dialog is useless.
5.3 Content need better sorting, it is not good stuff like "Included", "In another product", "Add as part" and "Invention request" is in same list.
5.4 After press "Investion request" it opens new view. Problem is anyone can't roll back without close dialog and start step 5.
5.5 List needs some intelligence sorting (torrent tracker system?) that you will see e.g. one bulb lamp, not many at one time. And system will select the best for you after press "Investion request".


Object.php
----------------------------------------------------
1. It seems like too much stuff is show on right panel (need limit, e.g. 5 stuff)
2. Photo near Veneer is clickable button
2.1 connector-setup doesn't work, because I fixed storage.php's connector-settings so they need sync.
2.2 more beautiful design needed
3. more features needed
4. Photo upload / browsing needed
5. without id makes errors, so e.g. referer to storage.php is good way to start.
6. This device is in queue In blue area (top of site)
6.1 Download C++ -program which will record hardware information from computer & push to website in logical structure.
7. Include compatible stuff -link doesn't exit yet after adding parts, and come back when no parts under Included -header in right bar

Profile.php - this is your name in showcase & storage in top of left bar
----------------------------------------------------
#1 Very old & dead look, but it has some ideas

1. Needs profile information (e.g. edit profile)
2. Contact information & Bank information needed
3. Reliability & Success -meters needed + feedback indicator


Security.php - this is under your name in showcase & storage in top of left bar
----------------------------------------------------
# For your security
1. Just a model, has partly competences like Tracking, needs more effects