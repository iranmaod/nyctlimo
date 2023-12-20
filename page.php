<?php
include("includes/open_con.php");
$seo_url = $_REQUEST['seo_url'];

include("page_status.php");

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="cufon-active cufon-ready">

    <head>


        <?php include("meta.php"); ?>
        
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        
       <?php /*?> <meta name="y_key" content="82b96231f2c607f4" />
        <meta name="verify-v1" content="d1rFYxCchQIcETRGKDlUlEIw6qzNV3cVoTgZx2DrEyA=" /> <?php */?>
        <meta name="robots" content="index,follow" />

        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.2r1/build/reset-fonts-grids/reset-fonts-grids.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?= SITE_PATH ?>/styles/new-styles.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?= SITE_PATH ?>/styles/res_menu.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?= SITE_PATH ?>/styles/responsive.css" /> 
        
        <script type="text/javascript" src="<?= SITE_PATH ?>/scripts/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="<?= SITE_PATH ?>/scripts/plugins.init.js"></script>
        <script type="text/javascript" src="<?= SITE_PATH ?>/scripts/jquery.cycle.all.min.js"></script>
        <script type="text/javascript" src="<?= SITE_PATH ?>/scripts/cufon-yui.js"></script>


        <style type="text/css">cufon{text-indent:0!important;}@media screen,projection{cufon{display:inline!important;display:inline-block!important;position:relative!important;vertical-align:middle!important;font-size:1px!important;line-height:1px!important;}cufon cufontext{display:-moz-inline-box!important;display:inline-block!important;width:0!important;height:0!important;overflow:hidden!important;text-indent:-10000in!important;}cufon canvas{position:relative!important;}}@media print{cufon{padding:0!important;}cufon canvas{display:none!important;}} 
        </style>
        <script type="text/javascript" src="/scripts/Rockwell_400-Rockwell_700.font.js"></script>

        <script src="/scripts/menu.js" type="text/javascript"></script>

        <script>
            if (document.location.search.indexOf("skipmobile") >= 0) {
                document.cookie = "skipmobile=1";
            }
            else if ((document.location.hostname.match(/\.mobi$/) || screen.width < 699)
                    && document.cookie.indexOf("skipmobile") == -1)
            {
                //document.location = "mobile.html";
            }
        </script>

        <!--[if IE 6]>
                <link rel="stylesheet" type="text/css" media="all" href="styles/ie6.css" />
        <![endif]-->
        <!--[if IE 7]>
                <link rel="stylesheet" type="text/css" media="all" href="styles/ie7.css" />
        <![endif]-->

        <link rel="icon" type="image/ico" href="images/favicon.ico?1244836905" />
        <link rel="Shortcut Icon" href="images/favicon.ico?1244836905" />


        <script type="text/javascript">
            Cufon.replace('h3.darkgreen, h3.white, h3.orange');
        </script>



        <script language="JavaScript" type="text/JavaScript">

            function MM_findObj(n, d) { //v4.01
            var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
            d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
            if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
            for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
            if(!x && d.getElementById) x=d.getElementById(n); return x;
            }

            function YY_checkform() { //v4.66
            //copyright (c)1998,2002 Yaromat.com
            var args = YY_checkform.arguments; var myDot=true; var myV=''; var myErr='';var addErr=false;var myReq;
            for (var i=1; i<args.length;i=i+4){
            if (args[i+1].charAt(0)=='#'){myReq=true; args[i+1]=args[i+1].substring(1);}else{myReq=false}
            var myObj = MM_findObj(args[i].replace(/\[\d+\]/ig,""));
            myV=myObj.value;
            if (myObj.type=='text'||myObj.type=='password'||myObj.type=='hidden'){
            if (myReq&&myObj.value.length==0){addErr=true}
            if ((myV.length>0)&&(args[i+2]==1)){ //fromto
            var myMa=args[i+1].split('_');if(isNaN(myV)||myV<myMa[0]/1||myV > myMa[1]/1){addErr=true}
            } else if ((myV.length>0)&&(args[i+2]==2)){
            var rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-z]{2,4}$");if(!rx.test(myV))addErr=true;
            } else if ((myV.length>0)&&(args[i+2]==3)){ // date
            var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);
            if(myAt){
            var myD=(myAt[myMa[1]])?myAt[myMa[1]]:1; var myM=myAt[myMa[2]]-1; var myY=myAt[myMa[3]];
            var myDate=new Date(myY,myM,myD);
            if(myDate.getFullYear()!=myY||myDate.getDate()!=myD||myDate.getMonth()!=myM){addErr=true};
            }else{addErr=true}
            } else if ((myV.length>0)&&(args[i+2]==4)){ // time
            var myMa=args[i+1].split("#"); var myAt=myV.match(myMa[0]);if(!myAt){addErr=true}
            } else if (myV.length>0&&args[i+2]==5){ // check this 2
            var myObj1 = MM_findObj(args[i+1].replace(/\[\d+\]/ig,""));
            if(myObj1.length)myObj1=myObj1[args[i+1].replace(/(.*\[)|(\].*)/ig,"")];
            if(!myObj1.checked){addErr=true}
            } else if (myV.length>0&&args[i+2]==6){ // the same
            var myObj1 = MM_findObj(args[i+1]);
            if(myV!=myObj1.value){addErr=true}
            }
            } else
            if (!myObj.type&&myObj.length>0&&myObj[0].type=='radio'){
            var myTest = args[i].match(/(.*)\[(\d+)\].*/i);
            var myObj1=(myObj.length>1)?myObj[myTest[2]]:myObj;
            if (args[i+2]==1&&myObj1&&myObj1.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
            if (args[i+2]==2){
            var myDot=false;
            for(var j=0;j<myObj.length;j++){myDot=myDot||myObj[j].checked}
            if(!myDot){myErr+='* ' +args[i+3]+'\n'}
            }
            } else if (myObj.type=='checkbox'){
            if(args[i+2]==1&&myObj.checked==false){addErr=true}
            if(args[i+2]==2&&myObj.checked&&MM_findObj(args[i+1]).value.length/1==0){addErr=true}
            } else if (myObj.type=='select-one'||myObj.type=='select-multiple'){
            if(args[i+2]==1&&myObj.selectedIndex/1==0){addErr=true}
            }else if (myObj.type=='textarea'){
            if(myV.length<args[i+1]){addErr=true}
            }
            if (addErr){myErr+='* '+args[i+3]+'\n'; addErr=false}
            }
            if (myErr!=''){alert('The required information is incomplete or contains errors:\t\t\t\t\t\n\n'+myErr)}
            document.MM_returnValue = (myErr=='');
            }

        </script>



    </head>


    <body>




        <div id="custom-doc">

            <?php include("includes/topheader.php"); ?>

            <div id="top_wrapper"> 

                <?php include("includes/topmenu.php"); ?>


                <div id="container">

                    <?php include("includes/sidebar.php"); ?>

                    <div id="mainContent" class="page-full-width-img"> 
                        <h1><?= $heading; ?></h1>
                        <?= $text; ?>

                    </div> 
                </div>
                <div id="content_wrapper_bottom"> </div>

            </div>





            <?php include("includes/footer.php"); ?>


        </div>


        <script type="text/javascript">
            $j(document).ready(function() {
                //Setup the main rotater on the home page
                $j('#divMainRotator').cycle({
                    speed: 600,
                    timeout: 6000,
                    pager: '#divMainRotatorNav',
                    pagerEvent: 'mouseover',
                    fastOnEvent: true
                });
            });
        </script>


        <script type="text/javascript"> Cufon.now();</script>




        <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
        </script>
        <script type="text/javascript">
            _uacct = "UA-559383-1";
            urchinTracker();
        </script>

    </body></html>