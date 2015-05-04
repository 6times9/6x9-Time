# 6x9 Time

##About

6x9 Time is a decimal time system inspired by Swatch Internet Time, but in a traditional format (i.e. hours, minutes, and seconds).

It should be noted that, although the idea may not be new, the script is all my own work.

It is based on UTC and, like its inspiration, has no timezones.

Until I can think of better names, the units are "hours", "minutes", and "seconds" and there are:

* 100 "seconds" in a "minute"
* 100 "minutes" in an "hour"
* 20 "hours" in a day (days are the same length as normal, just divided into 20 rather than 24).

Therefore, when it's 12pm normally, it's 10pm in 6x9 Time

By default the script uses a 20-hour clock, but it can be converted to 10-hour with minimal tweaking of the code (There should be comments by every relevent line).

**NOTE:** Although the clock uses JavaScript to display and update the time, the maths is performed by PHP. Your server will require PHP to use the clock.

##The Maths

Since the days are the same length, the current 6x9 Time is calculated using the number of real seconds since midnight at the start of the current day.

Knowing the number of each type of second in a day, seconds can be easily converted into "seconds" (1 second is 2.3148148148148 "seconds").

Having today's total number of elapsed "seconds", the "hours" and "minutes" can be calculated.

The 3 numbers are then passed to a modified version of the Timezone Cheat Clock.

Fortunately there are exactly 432 milliseconds in a "second", which makes looping the JavaScript very easy; the 1000 millisecond dealy is replaced with a 432 millisecond delay without having to worry about fractions.

##Using

Add

    <script src="6x9time.php" type="text/javascript"></script>

to the &lt;head&gt; section of the page, remembering to change the path to the script as appropriate.

Then add

    <span id="SxNtime"></span>

where you want the clock to appear.

You don't have to use a &lt;span&gt;; you can use anything, as long as you give it a unique ID and add that ID to the list in the script. The script comes preset to recognise the following 6 IDs: SxNtime, SxNtime1, SxNtime2, SxNtime3, SxNtime4, and SxNtime5.
