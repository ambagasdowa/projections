# Spinners

**Update 2013-Mar-12:** If you're looking for a good spinner implementation in code, you might want to give [spinjs](http://fgnass.github.com/spin.js/) a whirl. If you want some assets for spinners, grab them here.

I got tired of trying to find high quality spinners out there. Most of the ones you can scrape from the internet are kind of lame, not customizable, and only come in one size. (And Ajaxloader, great as it is, has hiccups in the frame that causes this weird strobing effect).

They're also not great when dealing with retina displays. This spinner set has enough intervals to cover you up to 96pt spinners.

### Contents

Project contains basic spinners, pixel-fitted as possible, in **black** and **white**, with dimensions of:

16 - 32 ... compact 8-leaf style (e.g. one found in iOS Status Bar)
24 - 48 - 96 - 192 ... normal 12-leaf style (found everywhere else)

/gif/
* .gif versions of the files. 
* They may be a little chubby, but .gifs usually are.

/psd/
* .psd originals of all spinners broken into layers.
* Customize colors, or export lighter weight versions of gifs.


### Technical

**Rotation Interval** ~0.8s rotation intervals seems to work the best for me; not fast enough to make you stressed out, and not so slow that the program feels slow.

**Why not CSS?** You need step animation to make this type of spinner feel like a true spinner. CSS3 step animations aren't available on all browsers, and they feel especially **laggy on mobile** platforms.

I'll add some CSS/HTML snippets for those who prefer that method in the future.





MIT License. Make the internet better.
