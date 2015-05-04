1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
16
17
18
19
20
21
22
23
24
25
26
27
28
29
30
31
32
33
34
35
36
37
38
39
40
41
42
43
44
45
46
47
48
49
50
51
52
53
54
55
56
57
58
59
60
61
62
63
64
65
66
67
68
69
70
71
72
73
74
75
76
77
78
<?php
 
header("content-type: application/x-javascript");
 
?>
 
// ===========================================
//                  6x9  Time
// ===========================================
//        Version "Aplha"  (2007-10-02)
//
//  http://www.6times9.com/javascript/6x9time
//
//       Copyright 2007 Richard Winskill
// ===========================================
 
<?php
 
//200,000 "seconds" in a day
//86400 seconds in a day
 
$secconv=200000/86400; //To convert seconds to "seconds"
$millicount=1000/$secconv; //Milliseconds in a "second", for JavaScript loop
 
$midnight=mktime(0, 0, 0, date("m"), date("d"), date("Y")); //PHP timecode for previous midnight
$seconds=time()-$midnight-date("Z"); //Seconds since previous midnight, corrected to UTC
 
//Calculate 6x9 time periods
$sec=$seconds*$secconv;
$hour=floor($sec/(100*100));
$sec=$sec-($hour*100*100);
$min=floor($sec/100);
$sec=floor($sec-($min*100));
 
?>
function run_stntime(){
        stntime(<?php echo $hour; ?>, <?php echo $min; ?>, <?php echo $sec; ?>, "SxNtime");
        stntime(<?php echo $hour; ?>, <?php echo $min; ?>, <?php echo $sec; ?>, "SxNtime1");
        stntime(<?php echo $hour; ?>, <?php echo $min; ?>, <?php echo $sec; ?>, "SxNtime2");
        stntime(<?php echo $hour; ?>, <?php echo $min; ?>, <?php echo $sec; ?>, "SxNtime3");
        stntime(<?php echo $hour; ?>, <?php echo $min; ?>, <?php echo $sec; ?>, "SxNtime4");
        stntime(<?php echo $hour; ?>, <?php echo $min; ?>, <?php echo $sec; ?>, "SxNtime5");
}
 
function stntime(chthour, chtmin, chtsec, chtid){
    //Only run if element exists
    if(document.getElementById(chtid)){
        //Add 1 to the seconds
            chtsec=chtsec+1;
        //When seconds reach 60, reset seconds to 0 and increase minutes by 1
            if(chtsec>99){chtsec=0; chtmin=chtmin+1;}
        //When minutes reach 60, reset minutes to 0 and increase hour by 1
            if(chtmin>99){chtmin=0; chthour=chthour+1;}
        //If hour is 0, make hour 24 (easier maths)
            if(chthour==0){chthour=20;}
        //When hour passes 24, reset hour to 1;
            if(chthour>20){chthour=1;}
        //If hour is before noon or hour is midnight, it's AM; otherwise it's PM
            if(chthour<10 || chthour==20){ap=" am";} else {ap=" pm";}
            ap=""; //Remove this line when switching to 10-hour display
        //Create "outhour" variable to display a 10-hour time but keep the maths right by remembering 24-hour "chthour" variable
            outhour=chthour
            //(10-hour time disabled, showing full 20-hour format. To enable 10-hour, uncomment line below)
            //if(outhour>10){outhour=outhour-10;}
        //Add a leading zero to seconds a minutes and hourif they are less than 10
            if(chtsec<10){secz="0";}else{secz="";}
            if(chtmin<10){minz="0";}else{minz="";}
            if(outhour<10){hourz="0";}else{hourz="";}
        //Output the time string to the HTML element with ID CHTID
            document.getElementById(chtid).innerHTML=hourz+outhour+":"+minz+chtmin+":"+secz+chtsec+ap;
        //Tell the function to repeat every 1000ms (1 second)
            setTimeout('stntime('+chthour+', '+chtmin+', '+chtsec+', "'+chtid+'")',<?php echo $millicount; ?>);
    }
}
 
//Handle other window.onload's
var prevonload=window.onload;
if(typeof(prevonload)=="function"){window.onload=function(){prevonload();run_stntime()}; }else{ window.onload=function(){run_stntime()}; }
