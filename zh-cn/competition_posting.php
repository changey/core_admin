<?php
ob_start();
include_once 'rnheader.php';
include_once 'sqlfoo.php';
include_once 'config.php';
?>

<script language="javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" language="javascript" src="assets/javascript/jquery-1.7.2.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="assets/javascript/jquery-1.2.1.pack.js"></script>
<link rel="stylesheet" type="text/css" href="../development-bundle/themes/ui-lightness/jquery.ui.all.css">
<script type="text/javascript" src="../development-bundle/jquery-1.7.2.js"></script>
<script type="text/javascript" src="../development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../development-bundle/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../development-bundle/ui/jquery.effects.core.js"></script>
<script type="text/javascript" src="../development-bundle/ui/jquery.effects.bounce.js"></script>
<script type="text/javascript" src="../development-bundle/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="../development-bundle/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../development-bundle/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="../development-bundle/ui/jquery.ui.autocomplete.js"></script>
<script type="text/javascript">
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("rpc.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>
<script type="text/javascript">
		$(function(){
		var pickerOpts = {
			altField: "#alt",
			altFormat: $.datepicker.TIMESTAMP
		};	
		$("#date").datepicker(pickerOpts);
		$("#date2").datepicker(pickerOpts);
	});
	</script>
<script type="text/javascript">
function validate()
{
var o = document.getElementById('nearby1');
var t = document.getElementById('nearby2');

if ( (o.checked == false ) && (t.checked == false ) )
{
alert ( "Please choose: Yes/No" );
document.frmSubscription.retailStores.focus();
return false;
}
return true;
}
</script>

<body>
<div class="inner">
<?php
echo ("<br /><br />");
$depplace = $_POST['from'];
$arrplace = $_POST['to'];
$deptime = $_POST['deptime'];
$arrtime =  $_POST['arrtime'];

/*if ($depplace == "" || $arrplace == "" || $deptime=="" || $arrtime =="") {
		echo $error = "Not all fields were entered<br />";
	}
else{
$depplace = $_POST['from'];
$arrplace = $_POST['to'];
$deptime = $_POST['deptime'];
$arrtime =  $_POST['arrtime'];
$flexibility = $_POST['flex'];
$people = $_POST['people'];
$class = $_POST['class'];
$nearby = $_POST['nearby'];
$anyairlines = $_POST['anyairlines'];
$multistops = $_POST['multistops'];
$addtional = $_POST['additional'];
$type = '';
$award = 0;
$paid = 0;
$date = date('m/d/Y h:i:s a', time());

$query = "INSERT INTO itinerary
(poster, depplace, arrplace, deptime,arrtime,flexibility, people, class,
nearby,multistops,anyairlines,additional,type,award,paid,time)
VALUES
('eric', '$depplace', '$arrplace','$deptime','$arrtime','$flexibility','$people',
'$class','$nearby','$anyairlines','$multistops','$additional','$type','','','$date')";
mysql_query($query, $con) or die(mysql_error($con));
$query = "INSERT INTO bids (trip_id, depplace, arrplace, deptime, arrtime)
                  SELECT id, depplace, arrplace, deptime, arrtime
                  FROM itinerary ORDER BY id DESC LIMIT 1";
		mysql_query($query) or die(mysql_error($con)); 

$query = "   SELECT id
             FROM itinerary ORDER BY id DESC LIMIT 1";
$result = mysql_query($query) or die(mysql_error($con)); 
while($row = mysql_fetch_array($result)){
	$trip_id=$row[0];
}	

mysql_close($con);
	//header("Location: fee.php?trip_id=" . $trip_id . "");
	//exit();
	ob_end_flush();	
}*/
//echo("<div class=\"whitebg\">");
echo ("<form method='post' action='experts.php'>")
?>
<table class="noborder">
<tr>
<td width=25%>
<LABEL for="from">From</LABEL>
<td width=25%>
<td width=25%>
<LABEL for="to">To</LABEL>
<tr>
<td><input type="text" compulsory="yes" size="30" value="" id="from1" name="from" />
<td>
<td><input type="text" size="30" value="" id="to1" name="to" />
<tr>
<td><LABEL for="depart">Depart Date</LABEL>
<td>
<td><LABEL for="return">Return Date</LABEL>
<tr>
<td><input type="text" size="30" value="" id="date" name="deptime" /></td>
<TD><select name="depflex">
<option value="3">+/- 3 days</option>
<option value="1">+/- 1 days</option>
<option value="0">No Flex</option>
</select>
<TD><input type="text" size="30" value="" id="date2" name="arrtime" /></td>
	
</td>
<TD><select name="arrflex">
<option value="3" >+/- 3 days</option>
<option value="1">+/- 1 days</option>
<option value="0">No Flex</option>
</select>
</TABLE><br />
This Flight is for <select name="people">
<option value="1p">1 person</option>
<option value="2p">2 people</option>
<option value="3p">3 people</option>
<option value="4p">4 people</option>
</select>
in <select name="class">
<option value="coach">Coach</option>
<option value="business">Business</option>
<option value="first">First</option>
</select>
class<br /><br />
<big><big>Your Flexibility</big></big><br />
<TABLE class="noborder">
<TR>
<TD width=85% >1. Is ground transportation to nearby airports ok for you?
<TD><input type='radio' name='nearby' value='1' id='nearby1'/>Yes
<TD><input type='radio' name='nearby' value='0' id='nearby2'/>No
<TR>
<TD width=85% >2. Is any airline, including discount airlines ok for you?
<TD><input type='radio' name='anyairlines' value='1'/>Yes
<TD><input type='radio' name='anyairlines' value='0'/>No
<TR>
<TD width=85% >3. Is long layover times and/or multiple stops ok for you? <TD>
<input type='radio' name='multistops' value='1'/>Yes <TD>
<input type='radio' name='multistops' value='0'/>No</td>
</TABLE>
<br />
Additional Requirments
<br />
<textarea name='addtional' cols='40' rows='3'></textarea>
<br />		<input class="buttonn" type='submit' value='A flight expert? join us. We will be launched soon.' />
</form>
</div>
</body>
<?php //include 'footer.php'; ?>
<script>
	$(function() {
		var availableTags = ["Aberdeen, SD (ABR) ",

"Abilene, TX (ABI)",

"Adak Island, AK (ADK)",

"Akiachak, AK (KKI)",

"Akiak, AK (AKI)",

"Akron/Canton, OH (CAK)",

"Akuton, AK (KQA)",

"Alakanuk, AK (AUK)",

"Alamogordo, NM (ALM)",

"Alamosa, CO (ALS)",

"Albany, NY (ALB)",

"Albany, OR - Bus service (CVO)",

"Albany, OR - Bus service (QWY)",

"Albuquerque, NM (ABQ)",

"Aleknagik, AK (WKK)",

"Alexandria, LA (AEX)",

"Allakaket, AK (AET)",

"Allentown, PA (ABE)",

"Alliance, NE (AIA)",

"Alpena, MI (APN)",

"Altoona, PA (AOO)",

"Amarillo, TX (AMA)",

"Ambler, AK (ABL)",

"Anaktueuk, AK (AKP)",

"Anchorage, AK (ANC)",

"Angoon, AK (AGN)",

"Aniak, AK (ANI)",

"Anvik, AK (ANV)",

"Appleton, WI (ATW)",

"Arcata, CA (ACV)",

"Arctic Village, AK (ARC)",

"Asheville, NC (AVL)",

"Ashland, KY/Huntington, WV (HTS)",

"Aspen, CO (ASE)",

"Athens, GA (AHN)",

"Atka, AK (AKB)",

"Atlanta, GA (ATL)",

"Atlantic City, NJ (AIY)",

"Atqasuk, AK (ATK)",

"Augusta, GA (AGS)",

"Augusta, ME (AUG)",

"Austin, TX (AUS)",

"Bakersfield, CA (BFL)",

"Baltimore, MD (BWI)",

"Bangor, ME (BGR)",

"Bar Harbour, ME (BHB)",

"Barrow, AK (BRW)",

"Barter Island, AK (BTI)",

"Baton Rouge, LA (BTR)",

"Bay City, MI (MBS)",

"Beaumont/Port Arthur, TX (BPT)",

"Beaver Creek, CO - Van service (ZBV)",

"Beaver, AK (WBQ)",

"Beckley, WV (BKW)",

"Bedford, MA (BED)",

"Belleville, IL (BLV)",

"Bellingham, WA (BLI)",

"Bemidji, MN (BJI)",

"Benton Harbor, MI (BEH)",

"Bethel, AK (BET)",

"Bethlehem, PA (ABE)",

"Bettles, AK (BTT)",

"Billings, MT (BIL)",

"Biloxi/Gulfport, MS (GPT)",

"Binghamton, NY (BGM)",

"Birch Creek, AK (KBC)",

"Birmingham, AL (BHM)",

"Bismarck, ND (BIS)",

"Block Island, RI (BID)",

"Bloomington, IL (BMI)",

"Bluefield, WV (BLF)",

"Boise, ID (BOI)",

"Boston, MA (BOS)",

"Boulder, CO - Bus service (XHH)",

"Boulder, CO - Hiltons Har H (WHH)",

"Boulder, CO - Municipal Airport (WBU)",

"Boundary, AK (BYA)",

"Bowling Green, KY (BWG)",

"Bozeman, MT (BZN)",

"Bradford, PA (BFD)",

"Brainerd, MN (BRD)",

"Brawnwood, TX (BWD)",

"Breckonridge, CO - Van service (QKB)",

"Bristol, VA (TRI)",

"Brookings, SD (BKX)",

"Brooks Lodge, AK (RBH)",

"Brownsville, TX (BRO)",

"Brunswick, GA (BQK)",

"Buckland, AK (BKC)",

"Buffalo, NY (BUF)",

"Bullhead City/Laughlin, AZ (IFP)",

"Burbank, CA (BUR)",

"Burlington, IA (BRL)",

"Burlington, VT (BTV)",

"Butte, MT (BTM)",

"Canton/Akron, OH (CAK)",

"Cape Girardeau, MO (CGI)",

"Cape Lisburne, AK (LUR)",

"Cape Newenham, AK (EHM)",

"Carbondale, IL (MDH)",

"Carlsbad, CA (CLD)",

"Carlsbad, NM (CNM)",

"Carmel, CA (MRY)",

"Casper, WY (CPR)",

"Cedar City, UT (CDC)",

"Cedar Rapids, IA (CID)",

"Central, AK (CEM)",

"Chadron, NE (CDR)",

"Chalkyitsik, AK (CIK)",

"Champaign/Urbana, IL (CMI)",

"Charleston, SC (CHS)",

"Charleston, WV (CRW)",

"Charlotte, NC (CLT)",

"Charlottesville, VA (CHO)",

"Chattanooga, TN (CHA)",

"Chefornak, AK (CYF)",

"Chevak, AK (VAK)",

"Cheyenne, WY (CYS)",

"Chicago, IL - Meigs (CGX)",

"Chicago, IL - All airports (CHI)",

"Chicago, IL - Midway (MDW)",

"Chicago, IL - O\'Hare (ORD)",

"Chicken, AK (CKX)",

"Chico, CA (CIC)",

"Chignik, AK - Fisheries (KCG)",

"Chignik, AK - (KCQ)",

"Chignik, AK - Lagoon (KCL)",

"Chisana, AK (CZN)",

"Chisholm/Hibbing, MN (HIB)",

"Chuathbaluk, AK (CHU)",

"Cincinnati, OH (CVG)",

"Circle Hot Springs, AK (CHP)",

"Circle, AK (IRC)",

"Clarks Point, AK (CLP)",

"Clarksburg, WV (CKB)",

"Clearwater/St Petersburg, FL (PIE)",

"Cleveland, OH (CLE)",

"Clovis, NM (CVN)",

"Cody/Yellowstone, WY (COD)",

"Coffee Point, AK (CFA)",

"Coffman Cove, AK (KCC)",

"Cold Bay, AK (CDB)",

"College Station, TX (CLL)",

"Colorado Springs, CO (COS)",

"Columbia, MO (COU)",

"Columbia, SC (CAE)",

"Columbus, GA (CSG)",

"Columbus, MS (GTR)",

"Columbus, OH (CMH)",

"Concord, CA (CCR)",

"Concordia, KS (CNK)",

"Copper Mountain, CO - Van service (QCE)",

"Cordova, AK (CDV)",

"Corpus Christi, TX (CRP)",

"Cortez, CO (CEZ)",

"Craig, AK (CGA)",

"Crescent City, CA (CEC)",

"Crooked Creek, AK (CKO)",

"Cube Cove, AK (CUW)",

"Cumberland, MD (CBE)",

"Dallas/Fort Worth, TX (DFW)",

"Dayton, OH (DAY)",

"Daytona Beach, FL (DAB)",

"Decatur, IL (DEC)",

"Deering, AK (DRG)",

"Delta Junction, AK (DJN)",

"Denver, CO - International (DEN)",

"Denver, CO - Longmont Bus service (QWM)",

"Des Moines, IA (DSM)",

"Detroit, MI - All airports (DTT)",

"Detroit, MI - Metro/Wayne County (DTW)",

"Devil\'s Lake, ND (DVL)",

"Dickinson, ND (DIK)",

"Dillingham, AK (DLG)",

"Dodge City, KS (DDC)",

"Dothan, AL (DHN)",

"Dubois, PA (DUJ)",

"Dubuque, IA (DBQ)",

"Duluth, MN (DLH)",

"Durango, CO (DRO)",

"Durham, NC (RDU)",

"Durham/Raleigh, NC (RDU)",

"Dutch Harbor, AK (DUT)",

"Easton, PA (ABE)",

"Eau Claire, WI (EAU)",

"Edna Bay, AK (EDA)",

"Eek, AK (EEK)",

"Ekuk, AK (KKU)",

"Ekwok, AK (KEK)",

"El Centro, CA (IPL)",

"El Dorado, AR (ELD)",

"El Paso, TX (ELP)",

"Elfin Cove, AK (ELV)",

"Elim, AK (ELI)",

"Elko, NV (EKO)",

"Elmira, NY (ELM)",

"Ely, MN (LYU)",

"Emmonak, AK (EMK)",

"Endicott, NY (BGM)",

"Enid, OK (WDG)",

"Erie, PA (ERI)",

"Escanaba, MI (ESC)",

"Eugene, OR (EUG)",

"Eureka/Arcata, CA (ACV)",

"Eureka, NV (EUE)",

"Evansville, IN (EVV)",

"Fairbanks, AK (FAI)",

"Fargo, ND (FAR)",

"Fayetteville, AR - Municipal/Drake (FYV)",

"Fayetteville, AR - Northwest Arkansas Regional (XNA)",

"Fayetteville, NC (FAY)",

"Flagstaff, AZ (FLG)",

"Flint, MI (FNT)",

"Florence, SC (FLO)",

"Florence/Muscle Shoals/Sheffield, AL (MSL)",

"Fort Collins/Loveland, CO - Municipal Airport (FNL)",

"Fort Collins/Loveland, CO - Bus service (QWF)",

"Fort Dodge, IA (FOD)",

"Fort Lauderdale, FL (FLL)",

"Fort Leonard Wood, MO (TBN)",

"Fort Myers, FL (RSW)",

"Fort Smith, AR (FSM)",

"Fort Walton Beach, FL (VPS)",

"Fort Wayne, IN (FWA)",

"Fort Worth/Dallas, TX (DFW)",

"Franklin, PA (FKL)",

"Fresno, CA (FAT)",

"Gainesville, FL (GNV)",

"Gallup, NM (GUP)",

"Garden City, KS (GCK)",

"Gary, IN (GYY)",

"Gillette, WY (GCC)",

"Gladewater/Kilgore, TX (GGG)",

"Glasgow, MT (GGW)",

"Glendive, MT (GDV)",

"Golovin, AK (GLV)",

"Goodnews Bay, AK (GNU)",

"Grand Canyon, AZ - Heliport (JGC)",

"Grand Canyon, AZ - National Park (GCN)",

"Grand Forks, ND (GFK)",

"Grand Island, NE (GRI)",

"Grand Junction, CO (GJT)",

"Grand Rapids, MI (GRR)",

"Grand Rapids, MN (GPZ)",

"Grayling, AK (KGX)",

"Great Falls, MT (GTF)",

"Green Bay, WI (GRB)",

"Greensboro, NC (GSO)",

"Greenville, MS (GLH)",

"Greenville, NC (PGV)",

"Greenville/Spartanburg, SC (GSP)",

"Groton/New London, CT (GON)",

"Gulfport, MS (GPT)",

"Gunnison, CO (GUC)",

"Gustavus, AK (GST)",

"Hagerstown, MD (HGR)",

"Hailey, ID (SUN)",

"Haines, AK (HNS)",

"Hampton, VA (PHF)",

"Hana, HI - Island of Maui (HNM)",

"Hanapepe, HI (PAK)",

"Hancock, MI (CMX)",

"Hanover, NH (LEB)",

"Harlingen, TX (HRL)",

"Harrisburg, PA (MDT)",

"Harrison, AR (HRO)",

"Hartford, CT (BDL)",

"Havasupai, AZ (HAE)",

"Havre, MT (HVR)",

"Hayden, CO (HDN)",

"Hays, KS (HYS)",

"Healy Lake, AK (HKB)",

"Helena, MT (HLN)",

"Hendersonville, NC (AVL)",

"Hibbing/Chisholm, MN (HIB)",

"Hickory, NC (HKY)",

"High Point, NC (GSO)",

"Hilo, HI - Island of Hawaii (ITO)",

"Hilton Head, SC (HHH)",

"Hobbs, NM (HBB)",

"Hollis, AK (HYL)",

"Holy Cross, AK (HCR)",

"Homer, AK (HOM)",

"Honolulu, HI - Island of Oahu (HNL)",

"Hoolehua, HI - Island of Molokai (MKK)",

"Hoonah, AK (HNH)",

"Hooper Bay, AK (HPB)",

"Hot Springs, AR (HOT)",

"Houston, TX - All airports (HOU)",

"Houston, TX - Hobby (HOU)",

"Houston, TX - Intercontinental (IAH)",

"Hughes, AK (HUS)",

"Huntington, WV/Ashland, KY (HTS)",

"Huntsville, AL (HSV)",

"Huron, SD (HON)",

"Huslia, AK (HSL)",

"Hyannis, MA (HYA)",

"Hydaburg, AK (HYG)",

"Idaho Falls, ID (IDA)",

"Igiugig, AK (IGG)",

"Iliamna, AK (ILI)",

"Imperial, CA (IPL)",

"Indianapolis, IN (IND)",

"International Falls, MN (INL)",

"Inyokern, CA (IYK)",

"Iron Mountain, MI (IMT)",

"Ironwood, MI (IWD)",

"Islip, NY (ISP)",

"Ithaca, NY (ITH)",

"Jackson Hole, WY (JAC)",

"Jackson, MS (JAN)",

"Jackson, TN (MKL)",

"Jacksonville, FL (JAX)",

"Jacksonville, NC (OAJ)",

"Jamestown, ND (JMS)",

"Jamestown, NY (JHW)",

"Janesville, WI (JVL)",

"Johnson City, NY (BGM)",

"Johnson City, TN (TRI)",

"Johnstown, PA (JST)",

"Jonesboro, AR (JBR)",

"Joplin, MO (JLN)",

"Juneau, AK (JNU)",

"Kahului, HI - Island of Maui, (OGG)",

"Kake, AK (KAE)",

"Kakhonak, AK (KNK)",

"Kalamazoo, MI (AZO)",

"Kalaupapa, HI - Island of Molokai, (LUP)",

"Kalskag, AK (KLG)",

"Kaltag, AK (KAL)",

"Kamuela, HI - Island of Hawaii, (MUE)",

"Kansas City, MO (MCI)",

"Kapalua, HI - Island of Maui, (JHM)",

"Kasaan, AK (KXA)",

"Kasigluk, AK (KUK)",

"Kauai Island/Lihue, HI (LIH)",

"Kearney, NE (EAR)",

"Keene, NH (EEN)",

"Kenai, AK (ENA)",

"Ketchikan, AK (KTN)",

"Key West, FL (EYW)",

"Keystone, CO - Van service (QKS)",

"Kiana, AK (IAN)",

"Kilgore/Gladewater, TX (GGG)",

"Killeen, TX (ILE)",

"King Cove, AK (KVC)",

"King Salmon, AK (AKN)",

"Kingman, AZ (IGM)",

"Kingsport, TN (TRI)",

"Kipnuk, AK (KPN)",

"Kirksville, MO (IRK)",

"Kivalina, AK (KVL)",

"Klamath Falls, OR (LMT)",

"Klawock, AK (KLW)",

"Knoxville, TN (TYS)",

"Kobuk, AK (OBU)",

"Kodiak, AK (ADQ)",

"Kona, HI - Island of Hawaii (KOA)",

"Kongiganak, AK (KKH)",

"Kotlik, AK (KOT)",

"Kotzebue, AK (OTZ)",

"Koyukuk, AK (KYU)",

"Kwethluk, AK (KWT)",

"Kwigillingok, AK (KWK)",

"La Crosse, WI (LSE)",

"Lafayette, IN (LAF)",

"Lafayette, LA (LFT)",

"Lake Charles, LA (LCH)",

"Lake Havasu City, AZ (HII)",

"Lake Minchumina, AK (LMA)",

"Lanai City, HI - Island of Lanai (LNY)",

"Lancaster, PA (LNS)",

"Lansing, MI (LAN)",

"Laramie, WY (LAR)",

"Laredo, TX (LRD)",

"Las Vegas, NV (LAS)",

"Latrobe, PA (LBE)",

"Laurel, MS (PIB)",

"Lawton, OK (LAW)",

"Lebanon, NH (LEB)",

"Levelock, AK (KLL)",

"Lewisburg, WV (LWB)",

"Lewiston, ID (LWS)",

"Lewistown, MT (LWT)",

"Lexington, KY (LEX)",

"Liberal, KS (LBL)",

"Lihue, HI - Island of Kaui (LIH)",

"Lincoln, NE (LNK)",

"Little Rock, AR (LIT)",

"Long Beach, CA (LGB)",

"Longview, TX (GGG)",

"Lopez Island, WA (LPS)",

"Los Angeles, CA (LAX)",

"Louisville, KY (SDF)",

"Loveland/Fort Collins, CO - Municipal Airport (FNL) ",

"Loveland/Fort Collins, CO - Bus service (QWF)",

"Lubbock, TX (LBB)",

"Macon, GA (MCN)",

"Madison, WI (MSN)",

"Madras, OR (MDJ)",

"Manchester, NH (MHT)",

"Manhattan, KS (MHK)",

"Manistee, MI (MBL)",

"Mankato, MN (MKT)",

"Manley Hot Springs, AK (MLY)",

"Manokotak, AK (KMO)",

"Marietta, OH/Parkersburg, WV (PKB)",

"Marion, IL (MWA)",

"Marquette, MI (MQT)",

"Marshall, AK (MLL)",

"Martha\'s Vineyard, MA (MVY)",

"Martinsburg, PA (AOO)",

"Mason City, IA (MCW)",

"Massena, NY (MSS)",

"Maui, HI (OGG)",

"Mcallen, TX (MFE)",

"Mccook, NE (MCK)",

"Mcgrath, AK (MCG)",

"Medford, OR (MFR)",

"Mekoryuk, AK (MYU)",

"Melbourne, FL (MLB)",

"Memphis, TN (MEM)",

"Merced, CA (MCE)",

"Meridian, MS (MEI)",

"Metlakatla, AK (MTM)",

"Meyers Chuck, AK (WMK)",

"Miami, FL - International (MIA)",

"Miami, FL - Sea Plane Base (MPB)",

"Midland, MI (MBS)",

"Midland/Odessa, TX (MAF)",

"Miles City, MT (MLS)",

"Milwaukee, WI (MKE)",

"Minneapolis, MN (MSP)",

"Minot, ND (MOT)",

"Minto, AK (MNT)",

"Mission, TX (MFE)",

"Missoula, MT (MSO)",

"Moab, UT (CNY)",

"Mobile, AL (MOB)",

"Modesto, CA (MOD)",

"Moline, IL (MLI)",

"Monroe, LA (MLU)",

"Monterey, CA (MRY)",

"Montgomery, AL (MGM)",

"Montrose, CO (MTJ)",

"Morgantown, WV (MGW)",

"Moses Lake, WA (MWH)",

"Mountain Home, AR (WMH)",

"Mountain Village, AK (MOU)",

"Muscle Shoals, AL (MSL)",

"Muskegon, MI (MKG)",

"Myrtle Beach, SC (MYR)",

"Nantucket, MA (ACK)",

"Napakiak, AK (WNA)",

"Napaskiak, AK (PKA)",

"Naples, FL (APF)",

"Nashville, TN (BNA)",

"Naukiti, AK (NKI)",

"Nelson Lagoon, AK (NLG)",

"New Chenega, AK (NCN)",

"New Haven, CT (HVN)",

"New Koliganek, AK (KGK)",

"New London/Groton (GON)",

"New Orleans, LA (MSY)",

"New Stuyahok, AK (KNW)",

"New York, NY - All airports (NYC)",

"New York, NY - Kennedy (JFK)",

"New York, NY - La Guardia (LGA)",

"Newark, NJ (EWR)",

"Newburgh/Stewart Field, NY (SWF)",

"Newport News, VA (PHF)",

"Newtok, AK (WWT)",

"Nightmute, AK (NME)",

"Nikolai, AK (NIB)",

"Nikolski, AK (IKO)",

"Noatak, AK (WTK)",

"Nome, AK (OME)",

"Nondalton, AK (NNL)",

"Noorvik, AK (ORV)",

"Norfolk, NE (OFK)",

"Norfolk, VA (ORF)",

"North Bend, OR (OTH)",

"North Platte, NE (LBF)",

"Northway, AK (ORT)",

"Nuiqsut, AK (NUI)",

"Nulato, AK (NUL)",

"Nunapitchuk, AK (NUP)",

"Oakland, CA (OAK)",

"Odessa/Midland, TX (MAF)",

"Ogdensburg, NY (OGS)",

"Oklahoma City, OK (OKC)",

"Omaha, NE (OMA)",

"Ontario, CA (ONT)",

"Orange County, CA (SNA)",

"Orlando, FL - Herndon (ORL)",

"Orlando, FL - International (MCO)",

"Oshkosh, WI (OSH)",

"Ottumwa, IA (OTM)",

"Owensboro, KY (OWB)",

"Oxnard/Ventura, CA (OXR)",

"Paducah, KY (PAH)",

"Page, AZ (PGA)",

"Palm Springs, CA (PSP)",

"Panama City, FL (PFN)",

"Parkersburg, WV/Marietta, OH (PKB)",

"Pasco, WA (PSC)",

"Pedro Bay, AK (PDB)",

"Pelican, AK (PEC)",

"Pellston, MI (PLN)",

"Pendleton, OR (PDT)",

"Pensacola, FL (PNS)",

"Peoria, IL (PIA)",

"Perryville, AK (KPV)",

"Petersburg, AK (PSG)",

"Philadelphia, PA - International (PHL)",

"Philadelphia, PA - Trenton/Mercer NJ (TTN)",

"Phoenix, AZ (PHX)",

"Pierre, SD (PIR)",

"Pilot Point, AK - Ugashnik Bay (UGB)",

"Pilot Point, AK (PIP)",

"Pilot Station, AK (PQS)",

"Pittsburgh, PA (PIT)",

"Platinum, AK (PTU)",

"Plattsburgh, NY (PLB)",

"Pocatello, ID (PIH)",

"Point Baker, AK (KPB)",

"Point Hope, AK (PHO)",

"Point Lay, AK (PIZ)",

"Ponca City, OK (PNC)",

"Ponce, Puerto Rico (PSE)",

"Port Alsworth, AK (PTA)",

"Port Angeles, WA (CLM)",

"Port Arthur/Beaumont, TX (BPT)",

"Port Clarence, AK (KPC)",

"Port Heiden, AK (PTH)",

"Port Moller, AK (PML)",

"Port Protection, AK (PPV)",

"Portage Creek, AK (PCA)",

"Portland, ME (PWM)",

"Portland, OR (PDX)",

"Portsmouth, NH (PSM)",

"Poughkeepsie, NY (POU)",

"Prescott, AZ (PRC)",

"Presque Isle, ME (PQI)",

"Princeton, WV (BLF)",

"Providence, RI (PVD)",

"Provincetown, MA (PVC)",

"Prudhoe Bay/Deadhorse, AK (SCC)",

"Pueblo, CO (PUB)",

"Pullman, WA (PUW)",

"Quincy, IL (UIN)",

"Quinhagak, AK (KWN)",

"Raleigh/Durham, NC (RDU)",

"Rampart, AK (RMP)",

"Rapid City, SD (RAP)",

"Reading, PA (RDG)",

"Red Devil, AK (RDV)",

"Redding, CA (RDD)",

"Redmond, OR (RDM)",

"Reno, NV (RNO)",

"Rhinelander, WI, (RHI)",

"Richmond, VA (RIC)",

"Riverton, WY (RIW)",

"Roanoke, VA (ROA)",

"Roche Harbor, WA (RCE)",

"Rochester, MN (RST)",

"Rochester, NY (ROC)",

"Rock Springs, WY (RKS)",

"Rockford, IL - Park&Ride Bus (ZRF)",

"Rockford, IL - Van Galder Bus (ZRK)",

"Rockland, ME (RKD)",

"Rosario, WA (RSJ)",

"Roswell, NM (ROW)",

"Ruby, AK (RBY)",

"Russian Mission, AK (RSH)",

"Rutland, VT (RUT)",

"Sacramento, CA (SMF)",

"Saginaw, MI (MBS)",

"Saint Cloud, MN (STC)",

"Saint George Island, AK (STG)",

"Saint George, UT (SGU)",

"Saint Louis, MO (STL)",

"Saint Mary\'s, AK (KSM)",

"Saint Michael, AK (SMK)",

"Saint Paul Island, AK (SNP)",

"Salem, OR (SLE)",

"Salina, KS (SLN)",

"Salisbury-Ocean City, MD (SBY)",

"Salt Lake City, UT (SLC)",

"San Angelo, TX (SJT)",

"San Antonio, TX (SAT)",

"San Diego, CA (SAN)",

"San Francisco, CA (SFO)",

"San Jose, CA (SJC)",

"San Juan, Puerto Rico (SJU)",

"San Luis Obispo, CA (SBP)",

"Sand Point, AK (SDP)",

"Santa Ana, CA (SNA)",

"Santa Barbara, CA (SBA)",

"Santa Fe, NM (SAF)",

"Santa Maria, CA (SMX)",

"Santa Rosa, CA (STS)",

"Saranac Lake, NY (SLK)",

"Sarasota, FL (SRQ)",

"Sault Ste Marie, MI, (CIU)",

"Savannah, GA (SAV)",

"Savoonga, AK (SVA)",

"Scammon Bay, AK (SCM)",

"Scottsbluff, NE (BFF)",

"Scottsdale, AZ (SDL)",

"Scranton, PA (AVP)",

"Seattle, WA - Lake Union SPB (LKE)",

"Seattle, WA - Seattle/Tacoma International (SEA)",

"Selawik, AK (WLK)",

"Seward, AK (SWD)",

"Shageluk, AK (SHX)",

"Shaktoolik, AK (SKK)",

"Sheffield/Florence/Muscle Shoals, AL (MSL)",

"Sheldon Point, AK (SXP)",

"Sheridan, WY (SHR)",

"Shishmaref, AK (SHH)",

"Shreveport, LA (SHV)",

"Shungnak, AK (SHG)",

"Silver City, NM (SVC)",

"Sioux City, IA (SUX)",

"Sioux Falls, SD (FSD)",

"Sitka, AK (SIT)",

"Skagway, AK (SGY)",

"Sleetmore, AK (SLQ)",

"South Bend, IN (SBN)",

"South Naknek, AK (WSN)",

"Southern Pines, NC (SOP)",

"Spartanburg/Greenville, SC (GSP)",

"Spokane, WA (GEG)",

"Springfield, IL (SPI)",

"Springfield, MO (SGF)",

"St Petersburg/Clearwater, FL (PIE)",

"State College/University Park, PA (SCE)",

"Staunton, VA (SHD)",

"Steamboat Springs, CO (SBS)",

"Stebbins, AK (WBB)",

"Stevens Point/Wausau, WI (CWA)",

"Stevens Village, AK (SVS)",

"Stewart Field/Newburgh, NY (SWF)",

"Stockton, CA (SCK)",

"Stony River, AK (SRV)",

"Sun Valley, ID (SUN)",

"Syracuse, NY (SYR)",

"Takotna, AK (TCT)",

"Talkeetna, AK (TKA)",

"Tallahassee, FL (TLH)",

"Tampa, FL (TPA)",

"Tanana, AK (TAL)",

"Taos, NM (TSM)",

"Tatitlek, AK (TEK)",

"Teller Mission, AK (KTS)",

"Telluride, CO (TEX)",

"Tenakee Springs, AK (TKE)",

"Terre Haute, IN (HUF)",

"Tetlin, AK (TEH)",

"Texarkana, AR (TXK)",

"Thief River Falls, MN (TVF)",

"Thorne Bay, AK (KTB)",

"Tin City, AK (TNC)",

"Togiak Village, AK (TOG)",

"Tok, AK (TKJ)",

"Toksook Bay, AK (OOK)",

"Toledo, OH (TOL)",

"Topeka, KS (FOE)",

"Traverse City, MI (TVC)",

"Trenton/Mercer, NJ (TTN)",

"Tucson, AZ (TUS)",

"Tulsa, OK (TUL)",

"Tuluksak, AK (TLT)",

"Tuntutuliak, AK (WTL)",

"Tununak, AK (TNK)",

"Tupelo, MS (TUP)",

"Tuscaloosa, AL (TCL)",

"Twin Falls, ID (TWF)",

"Twin Hills, AK (TWA)",

"Tyler, TX (TYR)",

"Unalakleet, AK (UNK)",

"Urbana/Champaign, IL (CMI)",

"Utica, NY (UCA)",

"Utopia Creek, AK (UTO)",

"Vail, CO - Eagle County Airport (EGE)",

"Vail, CO - Van service (QBF)",

"Valdez, AK (VDZ)",

"Valdosta, GA (VLD)",

"Valparaiso, FL (VPS)",

"Venetie, AK (VEE)",

"Ventura/Oxnard, CA (OXR)",

"Vernal, UT (VEL)",

"Victoria, TX (VCT)",

"Visalia, CA (VIS)",

"Waco, TX (ACT)",

"Wainwright, AK (AIN)",

"Wales, AK (WAA)",

"Walla Walla, WA (ALW)",

"Washington DC - All airports (WAS)",

"Washington DC - Dulles (IAD)",

"Washington DC - National (DCA)",

"Waterfall, AK (KWF)",

"Waterloo, IA (ALO)",

"Watertown, NY (ART)",

"Watertown, SD (ATY)",

"Wausau/Stevens Point, WI (CWA)",

"Wenatchee, WA (EAT)",

"West Palm Beach, FL (PBI)",

"West Yellowstone, MT (WYS)",

"Westchester County, NY (HPN)",

"Westerly, RI (WST)",

"Westsound, WA (WSX)",

"Whale Pass, AK (WWP)",

"White Mountain, AK (WMO)",

"White River, VT (LEB)",

"Wichita Falls, TX (SPS)",

"Wichita, KS (ICT)",

"Wilkes Barre, PA (AVP)",

"Williamsburg, VA (PHF)",

"Williamsport, PA (IPT)",

"Williston, ND (ISN)",

"Wilmington, NC (ILM)",

"Windsor Locks, CT (BDL)",

"Worcester, MA (ORH)",

"Worland, WY (WRL)",

"Wrangell, AK (WRG)",

"Yakima, WA (YKM)",

"Yakutat, AK (YAK)",

"Yellowstone/Cody, WY (COD)",

"Youngstown, OH (YNG)",

"Yuma, AZ (YUM)",

"Abbotsford, BC (YXX)",

"Akulivik, QC (AKV)",

"Aldershot, ON - Rail service (XLY)",

"Alexandria,ON - Rail service (XFS)",

"Alma, QC (YTF)",

"Anahim Lake, BC (YAA)",

"Angling Lake, ON (YAX)",

"Arctic Bay, NU (YAB)",

"Arviat, NU (YEK)",

"Attawapiskat, ON (YAT)",

"Aupaluk, QC (YPJ)",

"Bagotville, QC (YBG)",

"Baie Comeau, QC (YBC)",

"Baker Lake, NU (YBK)",

"Bathhurst, NB (ZBF)",

"Bearskin Lake, ON (XBE)",

"Bella Bella, BC (ZEL)",

"Bella Coola, BC (QBC)",

"Belleville, ON - Rail service (XVV)",

"Berens River, MB (YBV)",

"Big Trout, ON (YTL)",

"Black Tickle, NL (YBI)",

"Blanc Sablon, QC (YBX)",

"Bonaventure, QC (YVB)",

"Brampton, ON - Rail service (XPN)",

"Brandon, MB (YBR)",

"Brantford, ON - Rail service (XFV)",

"Brochet, MB (YBT)",

"Brockville, ON (XBR)",

"Burns Lake, BC (YPZ)",

"Calgary, AB (YYC)",

"Cambridge Bay, NU (YCB)",

"Campbell River, BC (YBL)",

"Campbellton, NB - Rail service (XAZ)",

"Cape Dorset, NU (YTE)",

"Capreol, ON - Rail service (XAW)",

"Cartwright, NL (YRF)",

"Casselman, ON - Rail service (XZB)",

"Castlegar, BC (YCG)",

"Cat Lake, ON (YAC)",

"Chambord, QC - Rail service (XCI)",

"Chandler, QC - Rail service (XDL)",

"Chapleau, ON (YLD)",

"Charlottetown, NL (YHG)",

"Charlottetown, PE (YYG)",

"Chatham, ON (XCM)",

"Chemainus, BC - Rail service (XHS)",

"Chesterfield Inlet, NU (YCS)",

"Chevery, QC (YHR)",

"Chibougamau, QC (YMT)",

"Chisasibi, QC (YKU)",

"Churchill Falls, NL (ZUM)",

"Churchill, MB - Rail service (XAD)",

"Churchill, MB (YYQ)",

"Clyde River, NU (YCY)",

"Cobourg, ON - Rail service (XGJ)",

"Colville Lake, NT (YCK)",

"Comox, BC (YQQ)",

"Coral Harbour, NU (YZS)",

"Cornwall, ON (YCC)",

"Coteau, QC - Rail service (XGK)",

"Courtenay, BC (YCA)",

"Cranbrook, BC (YXC)",

"Cross Lake, MB (YCR)",

"Dauphin, MB (YDN)",

"Davis Inlet, NL (YDI)",

"Dawson City, YT (YDA)",

"Dawson Creek, BC (YDQ)",

"Deer Lake, NL (YDF)",

"Deer Lake, ON (YVZ)",

"Deline, NT (YWJ)",

"Drummondville, QC - Rail service (XDM)",

"Dryden, ON (YHD)",

"Duncan/Quam, BC (DUQ)",

"East Main, QC (ZEM)",

"Edmonton, AB - Rail service (XZL)",

"Edmonton, AB - International (YEG)",

"Esquimalt, BC (YPF)",

"Flin Flon, MB (YFO)",

"Fond du Lac, SK (ZFD)",

"Fort Albany, ON (YFA)",

"Fort Chipewyan, AB (YPY)",

"Fort Frances, ON (YAG)",

"Fort Good Hope, NT (YGH)",

"Fort Hope, ON (YFH)",

"Fort Mcmurray, AB (YMM)",

"Fort Nelson, BC (YYE)",

"Fort Severn, ON (YER)",

"Fort Simpson, NT (YFS)",

"Fort Smith, NT (YSM)",

"Fort St John, BC (YXJ)",

"Fox Harbour/St Lewis, NL (YFX)",

"Fredericton Junction, NB - Rail service (XFC)",

"Fredericton, NB (YFC)",

"Gander, NL (YQX)",

"Gaspe, QC - Rail service (XDD)",

"Gaspe, QC (YGP)",

"Georgetown, ON - Rail service (XHM)",

"Gethsemani, QC (ZGS)",

"Gillam, MB (YGX)",

"Gillies Bay, BC (YGB)",

"Gjoa Haven, NU (YHK)",

"Glencoe, ON - Rail service (XZC)",

"Gods Narrows, MB (YGO)",

"Gods River, MB (ZGI)",

"Goose Bay, NL (YYR)",

"Grande Prairie, AB (YQU)",

"Grimsby, ON (XGY)",

"Grise Fiord, NU (YGZ)",

"Guelph, ON - Rail service (XIA)",

"Halifax, NS - Rail service (XDG)",

"Halifax, NS - International (YHZ)",

"Hall Beach, NU (YUX)",

"Hamilton, ON (YHM)",

"Havre St Pierre, QC (YGV)",

"Hay River, NT (YHY)",

"Hervey, QC - Rail service (XDU)",

"High Level, AB (YOJ)",

"Holman, NT (YHI)",

"Hopedale, NL (YHO)",

"Houston, BC - Bus station (ZHO)",

"Hudson Bay, SK (YHB)",

"Igloolik, NU (YGT)",

"Iles De La Madeleine, QC (YGR)",

"Ilford, MB (ILF)",

"Ingersoll, ON - Rail service (XIB)",

"Inukjuak, QC (YPH)",

"Inuvik, NT (YEV)",

"Iqaluit, NU (YFB)",

"Island Lake/Garden Hill (YIV)",

"Ivujivik, QC (YIK)",

"Jasper, AB - Rail service (XDH)",

"Joliette, QC - Rail service (XJL)",

"Jonquiere, QC - Rail service (XJQ)",

"Kamloops, BC (YKA)",

"Kangiqsualujjuaq, QC (XGR)",

"Kangiqsujuaq, QC (YWB)",

"Kangirsuk, QC (YKG)",

"Kapuskasing, ON (YYU)",

"Kasabonika, ON (XKS)",

"Kaschechewan, ON (ZKE)",

"Keewaywin, ON (KEW)",

"Kegaska, QC (ZKG)",

"Kelowna, BC (YLW)",

"Kenora, ON (YQK)",

"Kimmirut/Lake Harbour NU (YLC)",

"Kingfisher Lake, ON (KIF)",

"Kingston, ON - Rail service (XEG)",

"Kingston, ON - Norman Rogers Airport (YGK)",

"Kitchener, ON (YKF)",

"Klemtu, BC (YKT)",

"Kugaaruk, NU (YBB)",

"Kugluktuk/Coppermine, NU (YCO)",

"Kuujjuaq, QC (YVP)",

"Kuujjuarapik, QC (YGW)",

"La Grande, QC (YGL)",

"La Ronge, SK (YVC)",

"La Tabatiere, QC (ZLT)",

"La Tuque, QC (YLQ)",

"Lac Brochet, MB (XLB)",

"Lac Edouard, QC - Rail service (XEE)",

"Ladysmith, BC - Rail service (XEH)",

"Langford, BC - Rail service (XEJ)",

"Lansdowne House, ON (YLH)",

"Leaf Rapids, MB (YLR)",

"Lethbridge, AB (YQL)",

"Lloydminister, AB (YLL)",

"London, ON - Rail service (XDQ)",

"London, ON - Municipal Airport (YXU)",

"Lutselke/Snowdrift, NT (YSG)",

"Mary\'s Harbour, NL (YMH)",

"Maxville, ON - Rail service (XID)",

"Medicine Hat, AB (YXH)",

"Melville, SK - Rail service (XEK)",

"Miramichi, NB - Rail service (XEY)",

"Moncton, NB - Rail service (XDP)",

"Moncton, NB - Airport (YQM)",

"Mont Joli, QC (YYY)",

"Montreal, QC - Dorval Rail service (XAX)",

"Montreal, QC - Downtown Rail service (YMY)",

"Montreal, QC - St Lambert Rail service (XLM)",

"Montreal, QC - all airports (YMQ)",

"Montreal, QC - Dorval (YUL)",

"Montreal, QC - Mirabel (YMX)",

"Moosonee, ON (YMO)",

"Muskrat Dam, ON (MSA)",

"Nain, NL (YDP)",

"Nakina, ON (YQN)",

"Nanaimo, BC - Harbour Airport (ZNA)",

"Nanaimo, BC - Cassidy Airport (YCD)",

"Nanisivik, NU (YSR)",

"Napanee, ON - Rail service (XIF)",

"Natashquan, QC (YNA)",

"Nemiscau, QC (YNS)",

"New Carlisle, QC - Rail service (XEL)",

"New Richmond, QC - Rail service (XEM)",

"Niagara Falls, ON - Rail service (XLV)",

"Noranda/Rouyn, QC (YUY)",

"Norman Wells, NT (YVQ)",

"North Bay, ON (YYB)",

"North Spirit Lake, ON (YNO)",

"Norway House, MB (YNE)",

"Ogoki, ON (YOG)",

"Old Crow, YT (YOC)",

"Opapamiska Lake, ON (YBS)",

"Oshawa, ON (YOO)",

"Ottawa, ON - Rail service (XDS)",

"Ottawa, ON - International (YOW)",

"Oxford House, MB (YOH)",

"Pakuashipi, QC (YIF)",

"Pangnirtung, NU (YXP)",

"Parent, QC - Rail service (XFE)",

"Parksville, BC - Rail service (XPB)",

"Paulatuk, NT (YPC)",

"Peace River, AB (YPE)",

"Peawanuck, ON (YPO)",

"Pembroke, ON (YTA)",

"Penticton, BC (YYF)",

"Perce, QC - Rail service (XFG)",

"Pickle Lake, ON (YPL)",

"Pikangikum, ON (YPM)",

"Pointe-aux-Trembles, QC - Rail service (XPX)",

"Points North Landing, SK (YNL)",

"Pond Inlet, NU (YIO)",

"Poplar Hill, ON (YHP)",

"Port Alberni, BC (YPB)",

"Port Hardy, BC (YZT)",

"Port Hope Simpson, NL (YHA)",

"Port Meiner, QC (YPN)",

"Postville, NL (YSO)",

"Povungnituk, QC (YPX)",

"Powell River, BC (YPW)",

"Prescott, ON - Rail service (XII)",

"Prince Albert, SK (YPA)",

"Prince George, BC - Rail service (XDV)",

"Prince George, BC (YXS)",

"Prince Rupert, BC - Rail service (XDW)",

"Prince Rupert, BC - Digby Island Airport (YPR)",

"Pukatawagan, MB - (XPK)",

"Qikiqtarjuaq, NU (YVM)",

"Qualicum, BC (XQU)",

"Quaqtaq, QC (YQC)",

"Quebec, QC - International Airport (YQB)",

"Quebec, QC - Charny Rail service (YFZ)",

"Quebec, QC - Levis Rail service (XLK)",

"Quebec, QC - Quebec Station Rail service (XLJ)",

"Quebec, QC - Sainte-Foy Rail service (XFY)",

"Quesnel, BC (YQZ)",

"Rae Lakes, NT (YRA)",

"Rainbow Lake, AB (YOP)",

"Rankin Inlet, NU (YRT)",

"Red Lake, ON (YRL)",

"Red Sucker Lake, MB (YRS)",

"Regina, SK (YQR)",

"Repulse Bay, NU (YUT)",

"Resolute, NU (YRB)",

"Rigolet, NL (YRG)",

"Rimouski, QC (YXK)",

"Riviere-a-Pierre, QC - Rail service (XRP)",

"Roberval, QC (YRJ)",

"Round Lake, ON (ZRJ)",

"Rouyn/Noranda, QC (YUY)",

"Sachigo Lake, ON (ZPB)",

"Sachs Harbour, NT (YSY)",

"Sackville, NB - Rail service (XKV)",

"Saint Hyacinthe, QC - Rail service (XIM)",

"Saint John, NB (YSJ)",

"Saint Johns, NL (YYT)",

"Saint Leonard, NB (YSL)",

"Salluit, QC (YZG)",

"Sandy Lake, ON (ZSJ)",

"Sanikiluaq, NU (YSK)",

"Sarnia, ON - Rail service (XDX)",

"Sarnia, ON (YZR)",

"Saskatoon, SK (YXE)",

"Sault Ste-Marie, ON (YAM)",

"Schefferville, QC (YKL)",

"Senneterre, QC - Rail service (XFK)",

"Sept-Iles, QC (YZV)",

"Shamattawa, MB (ZTM)",

"Shawinigan, QC - Rail service (XFL)",

"Shawnigan, BC - Rail service (XFM)",

"Sioux Lookout, ON (YXL)",

"Smith Falls, ON (YSH)",

"Smithers, BC (YYD)",

"Snare Lake, NT (YFJ)",

"South Indian Lake, MB (XSI)",

"St Anthony, NL (YAY)",

"St Catharines, ON (YCM)",

"St Marys, ON - Rail service (XIO)",

"Ste Therese Point, MB (YST)",

"Stephenville, NL (YJT)",

"Stony Rapids, SK (YSF)",

"Strathroy, ON - Rail service (XTY)",

"Sudbury, ON - Rail service (XDY)",

"Sudbury, ON (YSB)",

"Summer Beaver, ON (SUR)",

"Swan River, MB (ZJN)",

"Sydney, NS (YQY)",

"Tadoule Lake, MB (XTL)",

"Taloyoak, NU (YYH)",

"Tasiujuaq, QC (YTQ)",

"Terrace, BC (YXT)",

"Tete-a-La Baleine, QC (ZTB)",

"The Pas, MB - Rail service (XDZ)",

"The Pas, MB (YQD)",

"Thicket Portage, MB (YTD)",

"Thompson, MB (YTH)",

"Thunder Bay, ON (YQT)",

"Timmins, ON (YTS)",

"Tofino, BC, (YAZ)",

"Toronto, ON - Downtown Rail service (YBZ)",

"Toronto, ON - Guildwood Rail service (XLQ)",

"Toronto, ON - Toronto Island Airport (YTZ)",

"Toronto, ON - International (YYZ)",

"Truro, NS - Rail service (XLZ)",

"Tuktoyaktuk, NT (YUB)",

"Tulita/Fort Norman, NT (ZFN)",

"Umiujag, QC (YUD)",

"Uranium City, SK (YBE)",

"Val-d\'Or, QC (YVO)",

"Vancouver, BC - Coal Harbour (CXH)",

"Vancouver, BC - Rail service (XEA)",

"Vancouver, BC - International (YVR)",

"Victoria, BC - Inner Harbor (YWH)",

"Victoria, BC - International (YYJ)",

"Wabush, NL (YWK)",

"Waskaganish, QC (YKQ)",

"Watford, ON - Rail service (XWA)",

"Webequie, ON (YWP)",

"Wemindji, QC (YNC)",

"Weymont, QC - Rail service (XFQ)",

"Wha Ti/Lac La Martre, NT (YLE)",

"Whale Cove, NU (YXN)",

"White River, ON (YWR)",

"Whitehorse, YT (YXY)",

"Williams Harbour, NL (YWM)",

"Williams Lake, BC (YWL)",

"Windsor, ON - Rail service (XEC)",

"Windsor, ON (YQG)",

"Winnipeg, MB - Rail service (XEF)",

"Winnipeg, MB - International (YWG)",

"Wollaston Lake, SK (ZWL)",

"Woodstock, ON - Rail service (XIP)",

"Wunnummin Lake, ON (WNN)",

"Wyoming, ON - Rail service (XWY)",

"Yarmouth, NS (YQI)",

"Yellowknife, NT (YZF)",

"York Landing, MB (ZAC)",

"Aalborg, Denmark (AAL)",

"Aalesund, Norway (AES)",

"Aarhus, Denmark - Bus service (ZID)",

"Aarhus, Denmark - Tirstrup (AAR)",

"Aasiaat, Greenland (JEG)",

"Abadan, Iran (ABD)",

"Abakan, Russia (ABA)",

"Aberdeen, United Kingdom (ABZ)",

"Abha, Saudi Arabia (AHB)",

"Abidjan, Cote d\'Ivoire (ABJ)",

"Abu Dhabi, United Arab Emirates (AUH)",

"Abu Simbel, Egypt (ABS)",

"Abuja, Nigeria (ABV)",

"Acapulco, Mexico (ACA)",

"Acarigua, Venezuela (AGV)",

"Accra, Ghana (ACC)",

"Adana, Turkey (ADA)",

"Addis Ababa, Ethopia (ADD)",

"Adelaide, Australia (ADL)",

"Aden, Yemen (ADE)",

"Adler/Sochi, Russia (AER)",

"Adrar, Algeria (AZR)",

"Afutara, Soloman Islands (AFT)",

"Agadir, Morocco (AGA)",

"Agartala, India (IXA)",

"Agaun, Papua New Guinea (AUP)",

"Agen, France (AGF)",

"Agra, India (AGR)",

"Agri, Turkey (AJI)",

"Aguadilla, Puerto Rico (BQN)",

"Aguascalientes, Mexico (AGU)",

"Aguni, Japan (AGJ)",

"Ahmedabad, India (AMD)",

"Ahwaz, Iran (AWZ)",

"Ailuk Island, Marshall Islands (AIM)",

"Aioun El Atrouss, Mauritania (AEO)",

"Airok, Marshall Islands (AIC)",

"Aitutaki, Cook Islands (AIT)",

"Aizawl, India (AJL)",

"Ajaccio, France (AJA)",

"Akita, Japan (AXT)",

"Aksu, China (AKU)",

"Aktyubinsk, Kazakhstan (AKX)",

"Akureyri, Iceland (AEY)",

"Al Ain, United Arab Emirates (AAN)",

"Al Arish, Egypt (AAC)",

"Al Ghaydah, Yemen (AAY)",

"Al Hoceima, Morocco (AHU)",

"Al-Baha, Saudi Arabia (ABT)",

"Albury, Australia (ABX)",

"Alderney, United Kingdom (ACI)",

"Aleppo, Syrian Arab Republic (ALP)",

"Alexander Bay, South Africa (ALJ)",

"Alexandria, Egypt (ALY)",

"Alexandroupolis, Greece (AXD)",

"Al-Fujairah, United Arab Emirates (FJR)",

"Alghero, Italy (AHO)",

"Algiers, Algeria (ALG)",

"Alicante, Spain (ALC)",

"Alice Springs, Australia (ASP)",

"Almaty, Kazakhstan (AKX)",

"Almeria, Spain (LEI)",

"Alor Island, Indonesia (ARD)",

"Alorsetar, Malaysia (AOR)",

"Alotau, Papua New Guinea (GUR)",

"Alta, Norway (ALF)",

"Altamira, Brazil (ATM)",

"Altay, China (AAT)",

"Altenrhein, Switzerland (ACH)",

"Alto Rio Senguerr, Argentina (ARR)",

"Amami O Shima, Japan (ASJ)",

"Amazon Bay, Papua New Guinea (AZB)",

"Ambanja, Madagascar (IVA)",

"Ambatomainty, Madagascar (AMY)",

"Ambatondrazaka, Madagascar (WAM)",

"Ambon, Indonesia (AMQ)",

"Amboseli, Kenya (ASV)",

"Amderma, Russia (AMV)",

"Amman, Jordan - Queen Alia International (AMM)",

"Amman, Jordan - Civil/Marka Airport (ADJ)",

"Amritsar, India (ATQ)",

"Amsterdam, Netherlands (AMS)",

"Anadyr, Russia (DYR)",

"Analalava, Madagascar (HVA)",

"Anapa, Russia (AAQ)",

"Ancona, Italy (AOI)",

"Andenes, Norway (ANX)",

"Andizhan, Uzbekistan (AZN)",

"Andros, Bahamas (ASD)",

"Aneityum, Vanuatu (AUY)",

"Angelholm/Helsingborg, Sweden (JHE)",

"Angers, France - Marce (ANE)",

"Angers, France - Rail service (QXG)",

"Anggi, Indonesia (AGD)",

"Anging, China (AQG)",

"Angouleme, France (ANG)",

"Anguilla, Anguilla (AXA)",

"Aniwa, Vanuatu (AWD)",

"Ankang, China (AKA)",

"Ankara, Turkey - Esenboga (ESB)",

"Ankara, Turkey - Etimesqut (ANK)",

"Ankavandra, Madagascar (JVA)",

"Annaba, Algeria (AAE)",

"Annecy, France (NCY)",

"Antalaha, Madagascar (ANM)",

"Antalya, Turkey (AYT)",

"Antaninvarivo, Madgascar (TNR)",

"Antigua, Antigua and Barbuda (ANU)",

"Antofagasta, Chile (ANF)",

"Antsalova, Madagascar (WAQ)",

"Antsiranana, Madagascar (DIE)",

"Antsohihy, Madagascar (WAI)",

"Antwerp, Belgium - Deurne Airport (ANR)",

"Antwerp, Belgium - Bus service (ZAY)",

"Aomori, Japan (AOJ)",

"Aosta, Italy (AOT)",

"Apartado, Colombia (APO)",

"Apia, Western Samoa (APW)",

"Apia, Western Samoa (FGI)",

"Aqaba, Jordan (AQJ)",

"Araca, Brazil (AJU)",

"Aracatuba, Brazil (ARU)",

"Arad, Romania (ARW)",

"Aragip, Papua New Guinea (ARP)",

"Araguaina, Brazil (AUX)",

"Arapoti, Brazil (AAG)",

"Arar, Saudi Arabia (RAE)",

"Arauca, Colombia (AUC)",

"Arba Mintch, Ethiopia (AMH)",

"Ardabil, Iran (ADU)",

"Arequipa, Peru (AQP)",

"Argelholm/Helsingborg, Sweden (AGH)",

"Argyle, Australia (GYL)",

"Arica, Chile (ARI)",

"Arkangelsk, Russia (ARH)",

"Armenia, Colombia (AXM)",

"Armidale, Australia (ARM)",

"Arthur\'s Town, Bahamas (ATC)",

"Arua, Uganda (RUA)",

"Aruba, Aruba (AUA)",

"Arusha, Tanzania (ARK)",

"Arvidsjaur, Sweden (AJR)",

"Asahikawa, Japan (AKJ)",

"Ashgabat, Turkmenistan (ASB)",

"Asmara, Eritrea (ASM)",

"Asosa, Ethopia (ASO)",

"Assiut, Egypt (ATZ)",

"Astana, Kazakhstan (TSE)",

"Astrakhan, Russia (ASF)",

"Asturias, Spain and Canary Islands (OVD)",

"Asuncion, Paraguay (ASU)",

"Aswan, Egypt (ASW)",

"Ataq, Yemen (AXK)",

"Athens, Greece (ATH)",

"Atiu Island, Cook Islands (AIU)",

"Atoifi, Solomon Islands (ATD)",

"Atuona, French Polynesia (AUQ)",

"Atyrau, Kazakhstan (GUW)",

"Auckland, New Zealand (AKL)",

"Augsburg/Munich, Germany (AGB)",

"Auki, Solomon Islands (AKS)",

"Aur Island, Marshall Islands (AUL)",

"Aurangabad, India (IXU)",

"Aurillac, France (AUR)",

"Aurukun, Australia (AUU)",

"Avignon, France (AVN)",

"Ayawaki, Indonesia (AYW)",

"Ayers Rock, Australia (AYQ)",

"Babo, Indonesia (BXB)",

"Bacolod, Philippines (BCD)",

"Badajcz, Spain (BJZ)",

"Bade, Indonesia (BXD)",

"Badu Island, Australia (BDD)",

"Bagdogra, India (IXB)",

"Baharpar, Ethiopia (BJR)",

"Bahawalpur, Pakistan (BHV)",

"Bahia Blanca, Argentina (BHI)",

"Bahia Pinas, Panama (BFQ)",

"Bahia Solano, Colombia (BSC)",

"Bahrain, Bahrain (BAH)",

"Baia Mare, Romania (BAY)",

"Baimuru, Papua New Guinea (VMU)",

"Baku, Azerbaijan (BAK)",

"Balalae, Solomon Islands (BAS)",

"Balikesir, Turkey (BZI)",

"Balikpapan, Indonesia (BPN)",

"Balimo, Papua New Guinea (OPU)",

"Ballina, Australia (BNK)",

"Balmaceda, Chile (BBA)",

"Bam, Iran (BXR)",

"Bamaga, Australia (ABM)",

"Bamako, Mali (BKO)",

"Banda Aceh, Indonesia (BTJ)",

"Bandar Abbas, Iran (BND)",

"Bandar Lampung, Indonesia - Branti (TKG)",

"Bandar Lengeh, Iran (BDH)",

"Bandar Seri Begawan, Brunei (BWN)",

"Bandung, Indonesia (BDO)",

"Bangalore, India (BLR)",

"Bangda, China (BPX)",

"Bangkok, Thailand (BKK)",

"Banja Luka, Bosnia Herzegovina (BNX)",

"Banjarmasin, Indonesia (BDJ)",

"Banjul, Gambia (BJL)",

"Banmethuot, Viet Nam - Phung-Doc (BMV)",

"Bannu, Pakistan (BNP)",

"Banqui, Central African Republic (BGF)",

"Baoshan, China (BSD)",

"Baotou, China (BAV)",

"Baracoa, Cuba (BCA)",

"Barcaldine, Australia (BCI)",

"Barcelona, Spain (BCN)",

"Barcelona, Venezuela (BLA)",

"Bardufoss, Norway (BDU)",

"Bari, Italy (BRI)",

"Barinas, Venezuela (BNS)",

"Bario, Malaysia (BBN)",

"Barisal, Bangladesh (BZL)",

"Barnaul, Russia (BAX)",

"Barquisimeto, Venezuela (BRM)",

"Barra Colorado, Costa Rica (BCL)",

"Barra, United Kingdom (BRR)",

"Barran Cabermeja, Colombia (EJA)",

"Barranquilla, Colombia (BAQ)",

"Barreiras, Brazil (BRA)",

"Basco, Philippines (BSO)",

"Basel, Switzerland (BSL)",

"Basel/Mulhouse Railway Station, Switzerland (ZDH)",

"Bashehr, Iran (BUZ)",

"Bastia, France (BIA)",

"Batam, Indonesia (BTH)",

"Bathurst Island, Australia (BRT)",

"Bathurst, Australia (BHS)",

"Batman, Turkey (BAL)",

"Batna, Algeria (BLJ)",

"Batom, Indonesia (BXM)",

"Batsfijord, Norway (BJF)",

"Battambang, Cambodia (BBM)",

"Batumi, Georgia (BUS)",

"Batuna, Solomon Islands (BPF)",

"Bauru, Brazil (BAU)",

"Bayamo, Cuba (BYM)",

"Bayreuth, Germany (BYU)",

"Bechar, Algeria (CBH)",

"Bedourie, Australia (BEU)",

"Beef Island, British Virgin Islands (EIS)",

"Beica, Ethiopia (BEI)",

"Beida, Libya - La Braq (LAQ)",

"Beihai, China (BHY)",

"Beijing, China (PEK)",

"Beira, Mozambique (BEW)",

"Beirut, Lebanon (BEY)",

"Bejaia, Algeria (BJA)",

"Belaga, Mozambique (BLG)",

"Belem, Brazil (BEL)",

"Belep Island, New Caledonia (BMY)",

"Belfast, Northern Ireland, United Kingdom (BFS)",

"Belfast, United Kingdom (BHD)",

"Belgorod, Russia (EGO)",

"Belgrade, Serbia and Montenegro - Beograd (BEG)",

"Belize City, Belize - International (BZE)",

"Belize City, Belize - Municipal (TZA)",

"Bellona, Solomon Islands (BNY)",

"Belo, Madagascar (BMD)",

"Belo Horizonte, Brazil - Tancredo Neves Intl. (CNF)",

"Belo Horizonte, Brazil - Pampulha (PLU)",

"Benbecula, United Kingdom (BEB)",

"Benghazi, Libya (BEN)",

"Bengkulu, Indonesia (BKS)",

"Berau, Indonesia (BEJ)",

"Berbera, Somalia (BBO)",

"Bergen, Norway (BGO)",

"Bergerac, France (EGC)",

"Berlevag, Norway (BVG)",

"Berlin, Germany - All airports (BER)",

"Berlin, Germany - Tegel (TXL)",

"Berlin, Germany - Tempelhof (THF)",

"Berlin, Germany - Schoenefeld (SXF)",

"Bermuda, Bermuda (BDA)",

"Berne, Switzerland - Belp Airport (BRN)",

"Berne, Switzerland - Rail service (ZDJ)",

"Besalampy, Madagascar (BPY)",

"Beziers, France (BZR)",

"Bhadrapur, Nepal (BDP)",

"Bhairawa, Nepal (BWA)",

"Bhamo, Myanmar (BMO)",

"Bharatpur, Nepal (BHR)",

"Bhavnagar, India (BHU)",

"Bhopal, India (BHO)",

"Bhubaneswar, India (BBI)",

"Bhuj, India (BHJ)",

"Biak, Indonesia (BIK)",

"Biarritz, France (BIQ)",

"Bikini Atoll, Marshall Islands (BII)",

"Bilbao, Spain (BIO)",

"Billund, Denmark (BLL)",

"Bima, Indonesia (BMU)",

"Bimini, Bahamas (BIM)",

"Bimini, Bahamas (NSB)",

"Bintulu, Malaysia (BTU)",

"Bintuni, Indonesia (NTI)",

"Biratragar, Nepal (BIR)",

"Birdsville, Australia (BVI)",

"Birmingham, United Kingdom (BHX)",

"Bisha, Saudi Arabia (BHH)",

"Bishkek, Kyrgyzstan (FRU)",

"Biskra, Algeria (BSK)",

"Bissau, Guinea-Bissau (OXB)",

"Blackall, Australia (BKQ)",

"Blackpool, United Kingdom (BLK)",

"Blackwater, Australia (BLT)",

"Blagoveschensk, Russia (BQS)",

"Blantyre, Malawi (BLZ)",

"Blenheim, New Zealand (BHE)",

"Blo Horizonte, Brazil (CNF)",

"Bloemfontein, South Africa (BFN)",

"Boa Vista, Cape Verde (BVC)",

"Boang, Papua New Guinea (BOV)",

"Boavista, Brazil (BVB)",

"Bocas Del Toro, Panama (BOC)",

"Bodo, Norway (BOO)",

"Bodrum, Turkey (BJV)",

"Bogota, Colombia (BOG)",

"Boiju Island, Australia (GIC)",

"Bojnord, Iran (BJB)",

"Bokondini, Indonesia (BUI)",

"Bol, Croatia (BWK)",

"Bolzano, Italy (BZO)",

"Boma, Congo (BOA)",

"Bombay, India (BOM)",

"Bonaire, Netherlands Antilles (BON)",

"Bonn, Germany (BNJ)",

"Bora Bora, French Polynesia (BOB)",

"Bordeaux, France (BOD)",

"Borg El Arab, Egypt (HBE)",

"Borkum, Germany (BMK)",

"Borlange, Sweden (BLE)",

"Bornholm, Denmark (RNN)",

"Borroloola, Australia (BOX)",

"Bossaro, Somalia (BSA)",

"Boulia, Australia (BQL)",

"Bourgas, Bulgaria (BOJ)",

"Bourke, Australia (BRK)",

"Bournemouth, United Kingdom (BOH)",

"Brack, Libya (BCQ)",

"Brampton Island, Australia (BMP)",

"Brasilia, DF, Brazil (BSB)",

"Bratislava, Slovakia (BTS)",

"Bratsk, Russia (BTK)",

"Braunschweig, Denmark (BWE)",

"Brazzaville, Congo (BZV)",

"Bremen, Germany (BRE)",

"Brest, France (BES)",

"Brewarrina, Australia (BWQ)",

"Bridgetown, Barbados (BGI)",

"Brindisi, Italy (BDS)",

"Brisbane, Queensland, Australia (BNE)",

"Bristol, United Kingdom (BRS)",

"Brive-La-Gaillarde, France - Laroche(BVE)",

"Brno, Czech Republic - Turany (BRQ)",

"Brno, Czech Republic - Bus service (ZDN)",

"Broken Hill, Australia (BHQ)",

"Bronnoysund, Norway (BNN)",

"Broome, Australia (BME)",

"Brus Laguna, Honduras (BHG)",

"Brussels, Belgium - National (BRU)",

"Brussels, Belgium - Rail service (ZYR)",

"Brussels, Belguim - Charleroi (CRL)",

"Bucaramanga, Colombia (BGA)",

"Bucharest, Romania - Baneasa (BBU)",

"Bucharest, Romania - Otopeni International (OTP)",

"Budapest, Hungary (BUD)",

"Buenos Aires, Argentina - Jorge Newbery (AEP)",

"Buenos Aires, Argentina - Ministro Pistarini (EZE)",

"Bugulma, Russia (UUA)",

"Bujumbura, Burundi (BJM)",

"Buka, Papua New Guinea (BUA)",

"Bukhara, Uzbekistan (BHK)",

"Bukoba, Malaysia (BKZ)",

"Bulawayo, Zimbabwe (BUQ)",

"Bulgulma, Russia (UUA)",

"Bundaberg, Australia (BDB)",

"Bunsil, Papua New Guinea (BXZ)",

"Burao, Somalia (BUO)",

"Bureta, Fiji (LEV)",

"Buri Ram, Thailand (BFV)",

"Burketown, Australia (BUC)",

"Burnie, Australia (BWT)",

"Busan, South Korea - Gimhae (PUS)",

"Butuan, Philippines (BXU)",

"Bydgoszcz, Poland (BZG)",

"Cabo San Lucas, \'Los Cabos\', Mexico (SJD)",

"Caen, France (CFR)",

"Cagayan De Oro, Philippines - Lumbia (CGY)",

"Cagliari, Italy (CAG)",

"Cairns, Australia (CNS)",

"Cairo, Egypt (CAI)",

"Cajamarca, Peru (CJA)",

"Calabar, Nigeria (CBQ)",

"Calama, Chile (CJC)",

"Calcutta, India (CCU)",

"Cali, Colombia (CLO)",

"Calvi, France (CLY)",

"Camaguey, Cuba (CMW)",

"Cambridge, United Kingdom (CBG)",

"Camodoro, Argentina (CRD)",

"Campbeltown, United Kingdom (CAL)",

"Campeche, Mexico (CPE)",

"Campina Grande, Brazil (CPV)",

"Campinas, Brazil (CPQ)",

"Campo Grande, Brazil (CGR)",

"Campos, Brazil (CAW)",

"Canaima, Venezuela (CAS)",

"Canberra, Australia (CBR)",

"Cancun, Mexico (CUN)",

"Cannes, France - Mandelieu (CEQ)",

"Cannes, France - Coisette Heliport (JCA)",

"Cannes, France - Vieux Port (QYW)",

"Canouan, Saint Vincent and the Grenadines (CIW)",

"Cap Haitien, Haiti (CAP)",

"Cape Orford, Papua New Guinea (CPI)",

"Cape Town, South Africa (CPT)",

"Cape Vogel, Papua New Guinea (CVL)",

"Caracas, Venezuela (CCS)",

"Carajas, Brazil (CKS)",

"Carcassonne, France (CCF)",

"Cardiff, United Kingdom (CWL)",

"Carnarvon, Australia (CVQ)",

"Carrillo, Costa Rica (RIK)",

"Cartagena, Colombia (CTG)",

"Carupani, Venezuela (CUP)",

"Casablanca, Morocco - Anfa (CAS)",

"Casablanca, Morocco - Mohamed V (CMN)",

"Cascavel, Brazil (CAC)",

"Casino, Australia (CSI)",

"Castaway, Fiji (CST)",

"Castres, France (DCM)",

"Catamarca, Argentina (CTC)",

"Catania, Italy (CTA)",

"Caucasia, Colombia (CAQ)",

"Caxias Do Sul, Brazil (CXJ)",

"Cayenne, French Guiana (CAY)",

"Cayman Brac Is, Cambodia (CYB)",

"Cayo Largo Del Sur, Cuba (CYO)",

"Cebu, Philippines - Matan International (CEB)",

"Cedun, Australia (CED)",

"Ceuta, Spain and Canary Islands (JCU)",

"Chah-Bahar, Iran (ZBR)",

"Chambery, France (CMF)",

"Chandigarh, India (IXC)",

"Changchun, China (CGQ)",

"Changde, China (CGD)",

"Changuinda, Panama (CHX)",

"Changzhou, China (CZX)",

"Chania, Greece (CHQ)",

"Chaoyang, China (CHG)",

"Chapeco, Brazil (XAP)",

"Charleville, Australia (CTL)",

"Chatham Island, New Zealand (CHT)",

"Cheboksary, Russia (CSY)",

"Chelybinsk, Russia (CEK)",

"Chennai, India (MAA)",

"Cheongju, South Korea (CJJ)",

"Cherepovets, Russia (CEE)",

"Chergdu, China (CTU)",

"Chester, United Kingdom (CEG)",

"Chetumal, Mexico (CTM)",

"Chevepovets, Russia (CEE)",

"Chi Mei, Taiwan (CMJ)",

"Chiang Mai, Thailand (CNX)",

"Chiang Rai, Thailand (CEI)",

"Chiayi, Taiwan (CYI)",

"Chicayo, Peru (CIX)",

"Chifeng, China (CIF)",

"Chihuahua, Mexico (CUU)",

"Chillan, Chile (YAI)",

"Chipata, Zambia (CIP)",

"Chisinau, Republic of Moldova (KIV)",

"Chita, Russia (HTA)",

"Chitral, Pakistan (CJL)",

"Chitre, Panama (CTD)",

"Chittagong, Bangladesh (CGP)",

"Choiseul Bay, Solomon Islands (CHY)",

"Chongqing, China (CKG)",

"Christchurch, New Zealand (CHC)",

"Christmas Island, Christmas Island (XCH)",

"Cicia, Fiji (ICI)",

"Ciego De Avila, Cuba (AVI)",

"Ciudad Bolivar, Venezuela (CBL)",

"Ciudad Del Carmen, Mexico (CME)",

"Ciudad del Este, Paraguay (AGT)",

"Ciudad Juarez, Mexico (CJS)",

"Ciudad Obregon, Mexico (CEN)",

"Ciudad Victoria, Mexico (CVM)",

"Clermont-ferrand, France (CFE)",

"Cleve, Australia (CVC)",

"Cloncurry, Australia (CNJ)",

"Club Makokola, Malawi (CMK)",

"Cluj, Romania (CLJ)",

"Cobar, Australia (CAZ)",

"Cobija, Bolivia (CIJ)",

"Cochabamba, Bolivia (CBB)",

"Cochin, India (COK)",

"Coconut Island, Australia (CNC)",

"Cocos Islands, Cocos (Keeling) Islands (CCK)",

"Coen, Australia (CUQ)",

"Coffs Harbor, Australia (CFS)",

"Coimbatore, India (CJB)",

"Colima, Mexico (CLQ)",

"Cologne, Germany - Rail service (QKL)",

"Cologne, Germany - Cologne/Bonn (CGN)",

"Colombo, Sri Lanka (CMB)",

"Colon, Panama (ONX)",

"Conakry, Guinea (CKY)",

"Concepcion, Chile (CCP)",

"Concordia, Argentina (COC)",

"Condoto, Colombia (COG)",

"Constanta, Romania (CND)",

"Constantine, Algeria (CZL)",

"Contadora, Panama (OTD)",

"Coober Pedy, Australia (CPD)",

"Cooktown, Australia (CTN)",

"Cooma, NS, Australia (OOM)",

"Coonamble, Australia (CNB)",

"Copenhagen, Denmark (CPH)",

"Copiapo, Chile (CPO)",

"Cordoba, Argentina (COR)",

"Cork, Ireland (ORK)",

"Coro, Venezuela (CZE)",

"Corozal, Belize (CZH)",

"Corrientes, Argentina (CNQ)",

"Corumba, Brazil (CMG)",

"Corvo Island, Portugal (CVU)",

"Cotabato, Philippines (CBO)",

"Cotarou, Benin (COC)",

"Cox\'s Bazar, Bangladesh (CXB)",

"Cozumel, Mexico (CZM)",

"Craig Cove, Vanuatu (CCV)",

"Criciuma, Brazil (CCM)",

"Croker Island, Australia (CKI)",

"Crooked Island, Bahamas (CRI)",

"Crotone, Italy (CRV)",

"Cruzeiro Do Sul, Brazil (CZS)",

"Cucata, Colombia (CUC)",

"Cuenca, Ecuador (CUE)",

"Cuernavaca, Mexico (CVJ)",

"Cuiaba, Brazil (CGB)",

"Culiacan, Mexico (CUL)",

"Cumana, Venezuela (CUM)",

"Cunnamulla, Australia (CMA)",

"Curacao, Netherlands Antilles (CUR)",

"Curitiba, Brazil (CWB)",

"Cuzco, Peru (CUZ)",

"Da Nang, Viet Nam (DAD)",

"Dabra, Indonesia (DRH)",

"Daegu, South Korea (TAE)",

"Dakar, Senegal (DKR)",

"Dakhla, Morocco (VIL)",

"Dalaman, Turkey (DLM)",

"Dalat, Viet Nam - Lienkhang DLI)",

"Dali City, China (DLU)",

"Dalian, China (DLC)",

"Damascus, Syrian Arab Republic (DAM)",

"Dammam, Saudi Arabia (DMM)",

"Dangriga, Belize (DGA)",

"Dar Es Salaam, Tanzania (DAR)",

"Darnley Island, QL, Australia (NLF)",

"Daru, Papua New Guinea (DAU)",

"Darwin, Northern Territory, Australia (DRW)",

"Datadawai, Indonesia (DTD)",

"Davao, Philipines - Mati (DVO)",

"David, Panama (DAV)",

"Dawe, Myanmar (TVY)",

"Daxian, China (DAX)",

"Dayang, China (DYG)",

"Daydream Is, Australia (DDI)",

"Deauville, France (DOL)",

"Debra Marcos, Ethiopia (DBM)",

"Debra Tabor, Ethiopia (DBT)",

"Deirezzor, Syria - Al Jafrah (DEZ)",

"Delhi, India (DEL)",

"Dembidollo, Ethiopia (DEM)",

"Denham, Australia (DNM)",

"Denizli, Turkey (DNZ)",

"Denpasar Bali, Indonesia (DPS)",

"Dera Ghazi, Pakistan (DEA)",

"Dera Ismail Khan, Pakistan (DSK)",

"Derby, Australia (DRB)",

"Derim, Papua New Guinea (DER)",

"Dessie, Ethiopia (DSE)",

"Devonport, Australia (DPO)",

"Dhaka, Bangledesh - Zia International (DAC)",

"Dibrugarn, India (DIB)",

"Dien Bien Phu, Viet Nam - Gialam (DIN)",

"Dijon, France (DIJ)",

"Dili, Indonesia (DIL)",

"Dillons Bay, Vanuata (DLY)",

"Dimapur, India (DMU)",

"Dinard, France (DNR)",

"Dipolog, Philippines (DPL)",

"Dire Dawa, Ethiopia (DIR)",

"Div, India (DIU)",

"Diyarbakir, Turkey (DIY)",

"Djanet, Algeria (DJG)",

"Djerba, Tunisia (DJE)",

"Djibouti, Djibouti (JIB)",

"Dnepropetrovsk, Ukraine (DNK)",

"Dobo, Indonesia (DOB)",

"Dodoma, Tanzania (DOD)",

"Dodoima, Papua New Guinea (DDM)",

"Doha, Qatar (DOH)",

"Dominica, Dominica - Cane Field (DCF)",

"Dominica, Dominica - Melville Hall (DOM)",

"Donegal, Ireland (CFN)",

"Donetsk, Ukraine (DOK)",

"Dongola, Sudan (DOG)",

"Doomadgee, Australia (DMD)",

"Dortmund, Germany (DTM)",

"Dourados, Brazil (DOU)",

"Dovala, Cameroon (DLA)",

"Dresden, Germany (DRS)",

"Dubai, United Arab Emirates (DXB)",

"Dubbo, Australia (DBO)",

"Dublin, Ireland (DUB)",

"Dubrovnik, Croatia (DBV)",

"Dumaguete, Philippines (DGT)",

"Dumai, Indonesia (DUM)",

"Dundee, United Kingdom (DND)",

"Dunedin, New Zealand (DUD)",

"Dunhuang, China (DNH)",

"Dunk Island, Australia (DKI)",

"Durango, Mexico (DGO)",

"Durban, South Africa (DUR)",

"Dushanbe, Tajikistan (DYU)",

"Dusseldorf, Germany - International (DUS)",

"Dusseldorf, Germany - Moenchen-Gl. (MGL)",

"Dusseldorf, Germany - Rail service (QDU)",

"Dzaoudzi, Mayotte (DZA)",

"East London, South Africa (ELS)",

"Ebon, Marshall Islands (EBO)",

"Eday, United Kingdom (EOI)",

"Edinburgh, United Kingdom (EDI)",

"Edremit, Turkey (EDO)",

"Edward River, Australia (EDR)",

"Egilsstadir, Iceland (EGS)",

"Eindhoven, Netherlands (EIN)",

"Eisenach, Germany (EIB)",

"Ekaterinburg, Russia (SVX)",

"El Bolsan, Argentina (EHL)",

"El Fasher, Sudan (ELF)",

"El Maiten, Argentina (EMX)",

"El Obeid, Sudan (EBD)",

"El Oved, Algeria (ELU)",

"El Portillo/Samana, Dominician Republic - El Portillo(EPS)",

"El Real, Panama (ELE)",

"El Salvador, Chile (ESR)",

"El Vigia, Venezuela (VIG)",

"El Yopal, Colombia (EYP)",

"Elat, Italy (ETH)",

"Elazig, Turkey (EZS)",

"Elba Island, Italy (EBA)",

"Elcho Island, Australia (ELC)",

"Eldoret, Kenya (EDL)",

"Eleuthera Island, Bahamas (ELH)",

"Elista, Russia (ESL)",

"Emae, Vanuata (EAE)",

"Embessa, Papua New Guinea (EMS)",

"Emerald, Australia (EMD)",

"Emo, Papua New Guinea (EMO)",

"Enarotali, Indonesia (EWI)",

"Ende, Indonesia (ENE)",

"Enewetak Island, Marshall Islands (ENT)",

"Enontekio, Finland (ENF)",

"Enshi, China (ENH)",

"Entebbe, Uganda (EBB)",

"Enugu, Nigeria (ENU)",

"Epinal, France (EPL)",

"Ercan, Cyprus (ECN)",

"Erfurt, Germany (ERF)",

"Erzincan, Turkey (ERC)",

"Erzurum, Turkey (ERZ)",

"Esbjerg, Denmark - Esbjerg Airport (EBJ)",

"Esbjerg, Denmark - Rail service (ZBB)",

"Esmeraldas, Ecuador (ESM)",

"Esperance, Australia (EPR)",

"Espiritu Santo, Vanuatu (SON)",

"Esquel, Argentina (EQS)",

"Eveter, United Kingdom (EXT)",

"Ewer, Indonesia (EWE)",

"Exmouth Gulf, Australia (EXM)",

"Fagernes, Norway (VDB)",

"Fair Isle, United Kingdom (FIE)",

"Faisalabad, Pakistan (LYP)",

"Fajard, Puerto Rico (FAJ)",

"Fak Fak, Indonesia (FKQ)",

"Fakarava, French Polynesia (FAV)",

"Farafangana, Madagascar (RVA)",

"Faro, Portugal (FAO)",

"Faroe Islands, Faroe Islands (FAE)",

"Fera Island, Solomon Islands (FRE)",

"Fergana, Uzbekistan (FEG)",

"Fernando De Noronha, Brazil (FEN)",

"Fez, Morocco (FEZ)",

"Fianarantsoa, Madagascar (WFI)",

"Figari, France (FSC)",

"Filton, United Kingdom (FZO)",

"Finkenwerder, Germany (XFW)",

"Fitzroy Crossing, Australia (FIZ)",

"Flensburg, Germany (FLF)",

"Florence, Italy - Gal Galilei (PSA)",

"Florence, Italy - Peretola (FLR)",

"Florencia, Colombia (FLA)",

"Flores Island, Portugal (FLW)",

"Flores, Guatemala (FRS)",

"Florianopolis, Brazil (FLN)",

"Floro, Norway (FRO)",

"Foggia, Italy (FOG)",

"Forde, Norway (FDE)",

"Formosa, Argentina (FMA)",

"Fort Dauphin, Madagascar (FTU)",

"Fort De France, Martinique (FDF)",

"Fortaleza, Brazil (FOR)",

"Franca, Brazil (FRC)",

"Franceville, Gabon (MVB)",

"Francistown, Botswana (FRW)",

"Frankfurt, Germany - Hahn (HHN)",

"Frankfurt, Germany - International (FRA)",

"Fredericia, Denmark (ZBJ)",

"Freeport, Bahamas (FPO)",

"Freetown, Sierra Leone - Lungi Intl (FNA)",

"Friedrichshafer, Germany (FDH)",

"Fuerteventura, Spain (FUE)",

"Fukuoka, Japan (FUK)",

"Fukue, Japan (FUJ)",

"Fukushima, Japan (FKS)",

"Funafuti Atol, Tuvalu (FUN)",

"Funchal, Portugal (FNC)",

"Futuna Island, Vanuatu (FTA)",

"Futuna Island, Wallis and Futuna Islands (FUT)",

"Fuyang, China (FUG)",

"Fuzhou, China (FOC)",

"Gaborone, Botswana (GBE)",

"Gafsa, Tunisia (GAF)",

"Gagnoa, Cote D\'Ivoire (GGN)",

"Galapagos, Ecuador (GPS)",

"Gallivare, Sweden (GEV)",

"Galway, Ireland (GWY)",

"Gamba, Gabon (GAX)",

"Gambela, Ethiopia (GMB)",

"Gan Island, Maldives (GAN)",

"Gangneung, South Korea (KAG)",

"Garachine, Panama (GHE)",

"Garaina, Papua New Guinea (GAR)",

"Garasa, Papua New Guinea (GRL)",

"Garden Point, Australia (GPN)",

"Garoua, Cameroon (GOV)",

"Gassim, Saudi Arabia (ELQ)",

"Gaua, Vanuatu (ZGU)",

"Gawahati, India (GAU)",

"Gaza City, Occupied Palestinian Territory (GZA)",

"Gaziatep, Turkey (GZT)",

"Gdansk, Poland (GDN)",

"Gebe, Indonesia (GEB)",

"Gelendzik, Russia (GDZ)",

"Geneina, Sudan (EGN)",

"General Santos, Philippines (GES)",

"Geneva, Switzerland (GVA)",

"Genoa, Italy (GOA)",

"George Town, Bahamas (GGT)",

"George, South Africa (GRJ)",

"Georgetown, Guyana (GEO)",

"Geraldton, Australia, (GET)",

"Gerona, Spain (GRO)",

"Ghadames, Libya (LTD)",

"Ghardala, Algeria (GHA)",

"Ghat, Libya (GHT)",

"Gibraltar, Gibraltar (GIB)",

"Gilgit, Pakistan (GIL)",

"Gisborne, New Zealand (GIS)",

"Gizan, Saudi Arabia (GIZ)",

"Gizo, Solomon Islands (GZO)",

"Gladstone, Australia (GLT)",

"Glasgow, United Kingdom - Glasgow International (GLA)",

"Glasgow, United Kingdom - Prestwick (PIK)",

"Glen Innes, Australia (GLI)",

"Goa, India (GOI)",

"Goba, Ethiopia (GOB)",

"Gobernador Gregores, Argentina (GGS)",

"Gode/Iddidole, Ethopia (GDE)",

"Goiania, Brazil (GYN)",

"Gold Coast, QL, Australia (OOL)",

"Golfito, Costa Rica (GLF)",

"Golmud, China (GOQ)",

"Gonalia, Papua New Guinea (GOE)",

"Gondari, Ethiopia (GDQ)",

"Gore, Ethiopia (GOR)",

"Goroka, Papua New Guinea (GKA)",

"Gorontalo, Indonesia (GTO)",

"Gothenburg, Sweden - Landvetter (GOT)",

"Gothenburg, Sweden - Saeve (GSE)",

"Goulburn Island, Australia (GBL)",

"Goundam, Mali (GUD)",

"Gove, Australia (GOV)",

"Governors Harbour, Bahamas (GHB)",

"Governador Valadares, Brazil (GVR)",

"Goya, CR, Argentina (OYA)",

"Gozo, Malta (GZM)",

"Graciosa Island, Portugal (GRW)",

"Grafton, Australia (GFN)",

"Granada, Spain (GRX)",

"Grand Cayman, Cayman Islands (GCM)",

"Grand Turk Island, Turks and Caicos Islands (GDT)",

"Graz, Austria (GRZ)",

"Grenada, Grenada, (GND)",

"Grenoble, France (GNB)",

"Griffith, Australia (GFF)",

"Grimsey, Iceland (GRY)",

"Groennedal, Greenland (JGR)",

"Groningen, Netherlands (GRQ)",

"Groofe Eylandt, Australia (GTE)",

"Guadalajara, Mexico (GDL)",

"Guam (GUM)",

"Guanaja, Honduras (GJA)",

"Guanajuato, Mexico (BJX)",

"Guangzhou, China (CAN)",

"Guantanamo, Cuba (GAO)",

"Guatemala City, Guatemala (GUA)",

"Guayaquil, Ecuador (GYE)",

"Guayaramerin, Bolivia (GYA)",

"Guaymas, Mexico (GYM)",

"Guernsey, United Kingdom (GCI)",

"Guerrero Negro, Mexico (GUB)",

"Guilin, China (KWL)",

"Guiria, Venezuela (GUI)",

"Gulu, Uganda (ULU)",

"Gulyang, China (KWE)",

"Gunsan, South Korea (KUV)",

"Gurayat, Saudi Arabia (URY)",

"Gwadar, Pakistan (GWD)",

"Gwangju, South Korea (KWJ)",

"Gwalior, India (GWL)",

"Gyandzha, Azerbaijan (KVD)",

"Gyourmri, Armenia (LWN)",

"HaApa, Tonga (HPA)",

"Hachijo Jima, Japan (HAC)",

"Hagfors, Sweden (HFS)",

"Haifa, Israel (HFA)",

"Haikou, China (HAK)",

"Hail, Saudi Arabia (HAS)",

"Hailar, China (HLD)",

"Haiphong, Viet Nam - Catbi (HPH)",

"Hakodate, Japan (HKD)",

"Halberstadt, Germany (ZHQ)",

"Halls Creek, Australia (HCQ)",

"Halmstad, Sweden (HAD)",

"Hamburg, Germany - Fuhisbuettel (HAM)",

"Hamburg, Germany - Luebeck (LBC)",

"Hamilton Island, Australia (HTI)",

"Hamilton, Bermuda (BDA)",

"Hamilton, New Zealand (HLZ)",

"Hammerfest, Norway (HFT)",

"Hangzhou, China (HGH)",

"Hanimaadhoo, Maldives (HAQ)",

"Hanoi, Viet Nam - Noibai (HAN)",

"Hanover, Germany (HAJ)",

"Hanzhang, China (HZG)",

"Harare, Zimbabwe (HRE)",

"Harbin, China (HRB)",

"Hargeisa, Somolia (HGA)",

"Harstad-Narvik, Norway (EVE)",

"Hassi Messaoud, Algeria (HME)",

"Hasvik, Norway (HAA)",

"Hat Yai, Thailand (HDY)",

"Hateruma, Japan (HTR)",

"Haugesund, Norway (HAU)",

"Havana, Cuba (HAV)",

"Hayman Island, Australia (HIS)",

"Hefei, China (HFE)",

"Heidelberg, Germany (HDB)",

"Helgoland, Germany (HGL)",

"Helsinki, Finland (HEL)",

"Heno, Myanmar (HEH)",

"Heraklian, Greece (HER)",

"Heringsdorf, Germany (HDF)",

"Hermavan, Sweden (HMV)",

"Hermosillo, Mexico (HMO)",

"Herning, Denmark (XAK)",

"Hervey Bay, Australia (HVB)",

"Hiroshima, Japan - International (HIJ)",

"Hiroshima, Japan - Hiroshima West (HIW)",

"Hivaro, Papua New Guinea (HIT)",

"Ho Chi Minh City, Viet Nam (SGN)",

"Hobart, Australia (HBA)",

"Hodeidah, Yemen (HOD)",

"Hoedspruit, South Africa (HDS)",

"Hof, Germany (HOQ)",

"Hofuf, Saudi Arabia (HOF)",

"Hohhot, China (HET)",

"Hokitika, New Zealand (HKK)",

"Holguin, Cuba (HOG)",

"Hong Kong, Hong Kong (HKG)",

"Honiara, Solomon Islands (HIR)",

"Honningsvag, Norway (HVG)",

"Hooker, Australia (HOK)",

"Horn Island Australia (HID)",

"Hornafjordur, Iceland (HFN)",

"Horta, Portugal (HOR)",

"Hoskins, Papua New Guinea (HKN)",

"Hotan, China (HTN)",

"Houeisay, Laos (HOE)",

"Houn, Libya (HUQ)",

"Huahine, French Polynesia (HUH)",

"Hualien, Taiwan - Phi Bai (HUN)",

"Hualtin, Thailand (HHQ)",

"Huanuco, French Polynesia (HUU)",

"Huargyan, China (HYN)",

"Huatulco, Mexico (HUX)",

"Hudiksvall, Sweden (HUV)",

"Hue, Viet Nam (HUI)",

"Hughenden, Australia (HGD)",

"Hultsfred, Sweden (HLF)",

"Humberside, United Kingdom (HUY)",

"Hurghada, Egypt (HRG)",

"Hwange Nat Park, Zimbabwe (HWN)",

"Hyderabad, India (HYD)",

"Iasi, Romania (IAS)",

"Ibague, Colombia (IBE)",

"Ibiza, Spain (IBZ)",

"Igarka, Russia (IAA)",

"Iguassu Falls, PR, Brazil (IGU)",

"Iguazu, Argentina (IGR)",

"Ihu, Papua New Guinea (IHU)",

"Ile Des Pins, New Caledonia (ILP)",

"Ilheus, Brazil (IOS)",

"Illaga, Indonesia (ILA)",

"Iloilo, Philippines - Mandurriao (ILO)",

"Ilu, Indonesia (IUL)",

"Ilulissat, Greenland (JAV)",

"Imperatriz, Brazil (IMP)",

"Imphal, India (IMF)",

"In Amenas, Algeria (IAM)",

"Inagua, Bahamas (IGA)",

"Inanwatan, Indonesia (INX)",

"Indagen, Papua New Guinea (IDN)",

"Indore, India (IDR)",

"Innsbruck, Austria (INN)",

"Inta, Russia (INA)",

"Invercargill, New Zealand (IVC)",

"Inverell, Australia (IVR)",

"Inverness, United Kingdom (INV)",

"Ioannina, Greece (IOA)",

"Ioma, Papua New Guinea (IOP)",

"Ipatinga, Brazil (IPN)",

"Ipiales, Colombia (IPI)",

"Ipil, Philippines (IPE)",

"Ipoh, Malaysia (IPH)",

"Ipota, Vanuatu (IPA)",

"Iquique, Chile (IQQ)",

"Iquitos, Peru (IQT)",

"Irkutsk, Russia (IKT)",

"Isafjordur, Iceland (IFJ)",

"Isfahan, Iran (IFN)",

"Ishigakij, Japan (ISG)",

"Islamabad, Pakistan (ISB)",

"Island Lake/Garden Hill, Canada (YIV)",

"Islay, United Kingdom (ILY)",

"Isle of Man, United Kingdom (IOM)",

"Isles of Scilly, United Kingdom - St Marys (ISC)",

"Isles of Scilly, United Kingdom - Tresco (TSO)",

"Istanbul, Turkey (IST)",

"Itaituba, Brazil (ITB)",

"Itokama, Papua New Guinea (ITK)",

"Ivalo, Finland (IVL)",

"Ivano-Frankovsk, Ukraine (IFO)",

"Iwami, Japan (IWJ)",

"Ixtapa, Mexico (ZIH)",

"Ixtepec, Mexico (IZT)",

"Izmir, Turkey (ADB)",

"Izumo, Japan (IZO)",

"Jabor, Marshall Islands (JAT)",

"Jacareacanga, Brazil (JCR)",

"Jacobabad, Pakistan (JAG)",

"Jacquinot Bay, Papua New Guinea (JAQ)",

"Jaipur, India (JAI)",

"Jakarta, Indonesia (CGK)",

"Jalapa, Mexico (JAL)",

"Jaluit Island, Marshall Islands (UIT)",

"Jambi. Indonesia (DJB)",

"Jamnagar, India (JGA)",

"Janakpur, Nepal (JKR)",

"Jaque, Panama (JQE)",

"Jayapura, Indonesia (DJJ)",

"Jeddah, Saudi Arabia (JED)",

"Jeh, Marshall Islands (JEJ)",

"Jeju, South Korea - Jeju Airport, metro area (CJU)",

"Jerez De La Frontere, Spain (XRY)",

"Jersey, United Kingdom (JER)",

"Jessore, Bangladesh (JSR)",

"Jiamusi, China (JMU)",

"Jiayuguan, China (JGN)",

"Jijel, Algeria (GJL)",

"Jijiga, Ethiopia (JIJ)",

"Jimma, Ethiopia (JIM)",

"Jinan, China (TNA)",

"Jingdezhen, China (JDZ)",

"Jinghong, China (JHG)",

"Jinja, Uganda (JIN)",

"Jinjiang, China (JJN)",

"Jinju, South Korea - Sancheon (HIN)",

"Jinka, Ethiopia (BCO)",

"Jinzhou, China (JNZ)",

"Ji-Parana, Brazil (JPR)",

"Jiwani, Pakistan (JIW)",

"Joao Pessoa, Brazil (JPA)",

"Jodhpur, India (JDH)",

"Joensuu, Finland (JOE)",

"Johannesburg, South Africa (JNB)",

"Johnston Island, US Minor Outlying Islands (JON)",

"Johor, Malaysia (JHB)",

"Joinville, Brazil (JOI)",

"Jommu, India (IXJ)",

"Jomsom, Nepal (JMO)",

"Jonkoping, Sweden (JKG)",

"Jorhat, India (JRH)",

"Jose De San Martin, Argentina (JSM)",

"Jouf, Saudi Arabia (AJF)",

"Juazeiro Do Norte, Brazil (JDO)",

"Juist, Germany (JUI)",

"Juiz De Fora, Brazil (JDF)",

"Jujuy, Argentina (JUJ)",

"Julia Creek, Australia (JCK)",

"Juliaca, Peru (JUL)",

"Juzha, China (JUZ)",

"Jyvaskyla, Finland (JYV)",

"Kaadedhdhoo, Maldives (KDM)",

"Kaben, Marshall Islands (KBT)",

"Kabri Dar, Ethiopia (ABK)",

"Kabul, Afghanistan (KBL)",

"Kabwun, Papua New Guinea (KBM)",

"Kadanwari, Pakistan (KCF)",

"Kadhonoo, Maldives (KDO)",

"Kaintiba, Papua New Guinea (KZF)",

"Kaitaia, New Zealand (KAT)",

"Kajaani, Finland (KAJ)",

"Kalbarri, Australia (KAX)",

"Kaliningrad, Russia (KGD)",

"Kambuaya, Indonesia (KBX)",

"Kameshli, Syrian Arab Republic (KAC)",

"Kamur, Indonesia (KCD)",

"Kamusi, Papua New Guinea (KUY)",

"Kano, Nigeria (KAN)",

"Karachi, Pakistan - Quaid-E-Azam International (KHI)",

"Kardia, Estonia (KDL)",

"Kariba, Zimbabwe (KAB)",

"Karlsruhe/Badern Baden, Germany (FKB)",

"Karpathos, Greece (AOK)",

"Karubaga, Indonesia (KBF)",

"Kasaba Bay, Zambia (ZKB)",

"Kasama, Zambia (KAA)",

"Kasane, Botswana (BBK)",

"Katherine, NT, Australia (KTR)",

"Kathmandu, Nepal (KTM)",

"Katowice, Poland (KTW)",

"Kaunas, Lithuania (KUN)",

"Kavala, Greece (KVA)",

"Kavieng, Papua New Guinea (KVG)",

"Kawthaung, Myanmar (KAW)",

"Kayseri, Turkey (ASR)",

"Kazan,, Russia (KZN)",

"Kefallinia, Greece (EFL)",

"Kendari, Indonesia (KDI)",

"Kerkyra, Greece (CFU)",

"Khajuraho, India (HJR)",

"Kharga, Egypt (UVL)",

"Kharkov, Ukraine (HRK)",

"Khudzhand, Tajikistan (LBD)",

"Khuzdar, Pakistan (KDD)",

"Kiev, Ukraine - Zhulhany (IEV)",

"Kiev, Ukraine - Borispol (KBP)",

"Kigali, Rwanda (KGL)",

"Kigoma, Tanzania (TKQ)",

"Kilimanjaro, Tanzania (JRO)",

"Kimmirut/Lake Harbour, Canada (YLC)",

"Kingston, Jamaica - Norman Manley (KIN)",

"Kingston, Jamaica - Tinson (KTP)",

"Kinshasa, Congo (FIH)",

"Kirakira, Solomon Islands (IRA)",

"Kitadaito, Japan (KTD)",

"Kittila, Finland (KTT)",

"Kiunga, Papua New Guinea (UNG)",

"Kiwayu, Kenya (KWY)",

"Knock, Ireland (NOC)",

"Kochi, Japan (KCZ)",

"Koh Samui, Thailand (USM)",

"Kolkata, India (CCU)",

"Kolobrzeg, Poland (QJY)",

"Komsomolsk Na Amure, Russia (KXK)",

"Konya, Turkey (KYA)",

"Koror, Palau (ROR)",

"Koszalin, Poland (OSZ)",

"Kota Bharu, Malaysia (KBR)",

"Kota Kinabalu, Malaysia (BKI)",

"Kowanyama, QL, Australia (KWM)",

"Kozhikode, India (CCJ)",

"Krabi, Thailand (KBV)",

"Krakow, Poland (KRK)",

"Krivoy Rog, Ukraine (KWG)",

"Kuala Lumpur, Malaysia (KUL)",

"Kuala Terengganu, Malaysia (TGG)",

"Kuantan, Malaysia (KUA)",

"Kubin Island, QL, Australia (KUG)",

"Kuching, Malaysia (KCH)",

"Kahramanmaras, Turkey (KCM)",

"Kudat, Malaysia (KUD)",

"Kufrah, Libya (AKF)",

"Kulusuk, Greenland (KUS)",

"Kumejima, Japan (UEO)",

"Kundiawa, Papau New Guinea (CMU)",

"Kuopio, Finland (KUO)",

"Kuri, Papua New Guinea (KUQ)",

"Kushiro, Japan (KUH)",

"Kutaisi, Georgia (KUT)",

"Kuusamo, Finland (KAO)",

"Kuwait, Kuwait (KWI)",

"Kwajalein, Marshall Islands (KWA)",

"Kyzyl, Russia (KYZ)",

"La Ceiba, Honduras (LCE)",

"La Coruna, Spain (LCG)",

"La Palma, Panama (PLP)",

"La Paz, Bolivia (LPB)",

"La Paz, Mexico (LAP)",

"La Rioja, Argentina (IRJ)",

"La Romana, Dominican Republic (LRM)",

"La Serena, Chile (LSC)",

"Laayoune, Morocco (EUN)",

"Labasa, Fiji (LBS)",

"Lablab, Papua New Guinea (LAB)",

"Labuan Bajo, Indonesia (LBJ)",

"Labuan, Malaysia (LBU)",

"Lae Island, Marshall Islands (LML)",

"Lae, Papua New Guinea (LAE)",

"Lages, SC, Brazil (LAJ)",

"Lago Agrio, Ecuador (LGQ)",

"Lago Argentina, Argentina (ING)",

"Lagos, Nigeria (LOS)",

"Lahadbatu, Malaysia (LDU)",

"Lahore, Pakistan (LHE)",

"Lakeba, Fiji (LKB)",

"Lakselv, Norway (LKL)",

"Lalibela, Ethiopia (LLI)",

"Lamap, Vanuatu (LPM)",

"Lamen Bay, Vanuatu (LNB)",

"Lamezia-Terme, Italy (SUF)",

"Lampang, Thailand (LPI)",

"Lampedusa, Italy (LMP)",

"Lamu, Kenya (LAU)",

"Lands End, United Kingdom (LEQ)",

"Langguri, Indonesia (LUV)",

"Langkawi, Malaysia (LGK)",

"Lannion, France (LAI)",

"Lanzarote, Spain (ACE)",

"Lanzhau, Guinea (LHW)",

"Lanzhou, China (ZGC)",

"Laoag, Philippines (LAO)",

"Lappeenranta, Finland (LPP)",

"Larantuka, Indonesia (LKA)",

"Larnaca, Cyprus (LCA)",

"Larochelle, France (LRH)",

"Las Palmas, Spain (LPA)",

"Las Piedras, Venezuela (LSP)",

"Latakia, Syria (LTK)",

"Laucala Island, Fiji (LUC)",

"Launceston, TS, Australia (LST)",

"Luanda, Angola (LAD)",

"Laverton, WA, Australia (LVO)",

"Lawas, Malaysia (LWY)",

"Le Havre, France (LEH)",

"Le Mans, France (ZLN)",

"Le Puy, France (LPY)",

"Le Touquet, France (LTQ)",

"Learmonth, WA, Australia (LEA)",

"Leeds, United Kingdom (LBA)",

"Legaspi, Philippines (LGP)",

"Leh, India (IXL)",

"Leinster, WA, Australia (LER)",

"Leipzig, Germany (LEJ)",

"Leknes, Norway (LKN)",

"Lemnos, Greece (LXS)",

"Leon, Mexico (BJX)",

"Leonora, WA, Australia (LNO)",

"Leticia, Colombia (LET)",

"Lhasa, China (LXA)",

"Lianyungang, China (LYG)",

"Liberia, Costa Rica (LIR)",

"Libreville, Gabon (LBV)",

"Lichinga, Mozambique (VXC)",

"Liege, Belgium (LGG)",

"Lifa, New Caledonia (LIF)",

"Lightning Ridge, NS, Australia (LHG)",

"Lihir Island, Papua New Guinea (LNV)",

"Lijiang City, China (LJG)",

"Likiep Island, Marshall Islands (LIK)",

"Lille, France - Lesquin (LIL)",

"Lille, France - Rail service (XDB)",

"Lilongwe, Malawi (LLW)",

"Lima, Peru (LIM)",

"Limbang, Malaysia (LMN)",

"Limoges, France (LIG)",

"Lindeman Island, QL, Australia (LDC)",

"Lindi, Tanzania (LDI)",

"Linkoping, Sweden (LPI)",

"Linyi, China (LYI)",

"Linz, Austria (LNZ)",

"Lisbon, Portugal (LIS)",

"Lismore, NS, Australia (LSY)",

"Liuzhou, China (LZH)",

"Liverpool, United Kingdom (LPL)",

"Livingstone, Zambia (LVI)",

"Lizard Island, QL, Australia (LZR)",

"Ljubliana, Slovenia (LJU)",

"Lockhart River, Australia (IRG)",

"Loen, Marshall Islands (LOF)",

"Loja, Ecuador (LOH)",

"Lome, Togo (LFW)",

"London, United Kingdom - All airports (LON)",

"London, United Kingdom - Biggin Hill (BQH)",

"London, United Kingdom - Gatwick (LGW)",

"London, United Kingdom - Heathrow (LHR)",

"London, United Kingdom - London City (LCY)",

"London, United Kingdom - Luton (LTN)",

"London, United Kingdom - Stansted (STN)",

"Londonderry, United Kingdom (LDY)",

"London-Paddington, United Kingdom - Rail service (QQP)",

"Londrina, PR, Brazil (LDB)",

"Long Apung, Indonesia (LPU)",

"Long Banga, Malaysia (LBP)",

"Long Bawan, Indonesia (LBW)",

"Long Island, Australia (HAP)",

"Long Island/Deadmans Cay, Bahamas (LGI)",

"Long Lellang, Malaysia (LGL)",

"Long Seridan, Malaysia (ODN)",

"Longana, Vanuatu (LOD)",

"Longreach, QL, Australia (LRE)",

"Longyearbyen, Svalbard & Jan Mayen Island (LYR)",

"Lonorore, Vanuatu (LNE)",

"Lord Howe Island, NS, Australia (LDH)",

"Loreto, Mexico (LTO)",

"Lorient, France (LRT)",

"Los Cabos, Mexico (SJD)",

"Los Mochis, Mexico (LMM)",

"Losuia, Papua New Guinea (LSA)",

"Lourdes/Tarbes, France (LDE)",

"Lozaro Cardenas, Mexico (LZC)",

"Luanda, Angola (LAD)",

"Luang Namtha, Laos (LXG)",

"Luang Prabang, Laos (LPQ)",

"Lucknow, India (LKO)",

"Luderitz, Namibia (LUD)",

"Lugano, Switzerland (LUG)",

"Lugansk, Uganda (VSG)",

"Lukla, Nepal (LUA)",

"Lulea, Sweden (LLA)",

"Lumbashi, Congo (FBM)",

"Luoyang, China (LYA)",

"Lusaka, Zambia (LUN)",

"Luwuk, Indonesia (LUW)",

"Luxembourg, Luxembourg (LUX)",

"Luxi, China (LUM)",

"Luxor, Egypt (LXR)",

"Luzhou, China (LZO)",

"Lvov, Ukraine (LWO)",

"Lyoksele, Sweden (LYC)",

"Lyon, France - Satolas (LYS)",

"Lyon, France - Lyon Part-Dieu Rail service (XYD)",

"Maastricht, Netherlands (MST)",

"Mabuiag Island, QL, Australia (UBB)",

"Macapa, AP, Brazil (MCP)",

"Macas, Ecuador (XMS)",

"Macau, China (MFM)",

"Maceio, AL, Brazil (MCZ)",

"Machala, Ecuador (MCH)",

"Mackay, QL, Australia (MKY)",

"Madang, Papua New Guinea (MAG)",

"Madinah, Saudi Arabia (MED)",

"Madrid, Spain (MAD)",

"Madurai, India (IXM)",

"Mae Hong Son, Thailand (HGN)",

"Mae Sot, Thailand (MAQ)",

"Maewo, Vanuatu (MWF)",

"Mafia, Tanzania (MFA)",

"Magadan, Russia (GDX)",

"Magnitogorsk, Russia (MQF)",

"Mahanoro, Madagascar (VVB)",

"Mahe Island, Seychelles (SEZ)",

"Maintirano, Madagascar (MXT)",

"Maio, Cape Verde (MMO)",

"Majkin, Marshall Islands (MJE)",

"Majunga, Madagascar (MJN)",

"Majuro, Marshall Islands (MAJ)",

"Makale, Ethiopia (MQX)",

"Makhachkala, Russia (MCX)",

"Makokou, Gabon (MKU)",

"Makung, Taiwan (MZG)",

"Malabo, Equatorial Guinea (SSG)",

"Malacca, Malaysia (MKZ)",

"Malaga, Spain (AGP)",

"Malakai, Sudan (MAK)",

"Malargue, MD, Argentina (LGS)",

"Malatya, Turkey (MLX)",

"Male, Maldives (MLE)",

"Malindi, Kenya (MYD)",

"Malmo, Sweden (MMX)",

"Maloelap Island, Marshall Islands (MAV)",

"Malololailai, Fiji (PTF)",

"Malta, Malta (MLA)",

"Mampikony, Madagascar (WMP)",

"Mana Island, Fiji (MNF)",

"Manado, Indonesia (MDC)",

"Managua, Nicaragua (MGA)",

"Manakara, Madagascar (WVK)",

"Mananara, Madagascar (WMR)",

"Manang, Nepal (NGX)",

"Mananjary, Madagascar (MNJ)",

"Manaus, AM, Brazil (MAO)",

"Manchester, United Kingdom (MAN)",

"Mandalay, Myanmar (MDL)",

"Mandritsara, Madagascar (WMA)",

"Mangaia Island, Cook Islands (MGS)",

"Mangalore, India (IXE)",

"Mangrove Cay, Bahamas (MAY)",

"Mangu, Zambia (MNR)",

"Manguna, Papua New Guinea (MFO)",

"Manihi, French Polynesia (XMH)",

"Manihiki Island, Cook Islands (MHX)",

"Manila, Philippines (MNL)",

"Maningrioa, NT, Australia (MNG)",

"Manizales, Colombia (MZL)",

"Manja, Madagascar (MJA)",

"Mannheim, Germany (MHG)",

"Manokwari, Indonesia (MKW)",

"Manston, United Kingdom (MSE)",

"Manta, Ecuador (MEC)",

"Manus Island, Papua New Guinea (MAS)",

"Manzanillo, Cuba (MZO)",

"Manzanillo, Mexico (ZLO)",

"Manzini, Swaziland (MTS)",

"Mao, Chad (AMO)",

"Maota Savaii Is, Western Samoa (MXS)",

"Maputo, Mozambique (MPM)",

"Mar Del Plata, BA, Argentina (MDQ)",

"Mara Lodges, Kenya (MRE)",

"Maraba, PA, Brazil (MAB)",

"Maracaibo, Venezuela (MAR)",

"Maracay, Venezuela (MYC)",

"Mare, New Caledonia (MEE)",

"Margate, South Africa (MGH)",

"Maribor, Slovenia (MBX)",

"Mariehamn, Finland (MHQ)",

"Mariitsoq, Greenland (JSU)",

"Marilia, SP, Brazil (MII)",

"Maringa, PR, Brazil (MGF)",

"Mariupol, Ukraine (MPW)",

"Maroantsetra, Madagascar (WMN)",

"Marova, Cameroon (MVR)",

"Marseille, France (MRS)",

"Marsh Harbour, Bahamas (MHH)",

"Marudi, Malaysia (MUR)",

"Maryborough, QL, Australia (MBH)",

"Masbate, Philippines (MBT)",

"Maseru, Lesotho (MSU)",

"Mashad, Iran (MHD)",

"Matamoros, Mexico (MAM)",

"Mataram, Indonesia (AMI)",

"Matsumoto, Japan (MMJ)",

"Matsuyama, Japan (MYJ)",

"Maturin, Venezuela (MUN)",

"Mauke Island, Cook Islands (MUK)",

"Maulmyine, Myanmar (MNU)",

"Maumere, Indonesia (MOF)",

"Maun, Botswana (MUB)",

"Maupiti, French Polynesia (MAU)",

"Mauritius, Mauritius (MRU)",

"Mayaguana, Bahamas (MYG)",

"Mayaguez, Puerto Rico (MAZ)",

"Mazatlan, Mexico (MZT)",

"Mbandaka, Congo (MDK)",

"Mbuji Mayi, Congo (MJM)",

"Mcarthur River, NT, Australia (MCV)",

"Medan, Indonesia (MES)",

"Medellin, Colombia - Enrique Olaya Herrera (EOH)",

"Medellin, Colombia - Jose Marie Cordova (MDE)",

"Meekatharra, WA, Australia (MKR)",

"Mehamn, Norway (MEH)",

"Meixian, China (MXZ)",

"Mejit Island, Marshall Islands (MJB)",

"Mekane Selam, Ethiopia (MKS)",

"Melbourne, Victoria, Australia (MEL)",

"Melilla, Spain (MLN)",

"Memanbetsu, Japan (MMB)",

"Mendi, Ethiopia (NDM)",

"Mendi, Papua New Guinea (MDU)",

"Mendoza, MD, Argentina (MDZ)",

"Menorca, Spain (MAH)",

"Menyamya, Papua New Guinea (MYX)",

"Merauke, Indonesia (MKQ)",

"Merave, Sudan (MWE)",

"Merdey, Indonesia (RDE)",

"Merida, Mexico (MID)",

"Merida, Venezuela (MRD)",

"Merimbula, NS, Australia (MIM)",

"Mersa Matruh, Egypt (MUH)",

"Metz/Nancy, France (ETZ)",

"Mexicali, Mexico (MXL)",

"Mexico City, Mexico (MEX)",

"Mfume, Zambia (MFU)",

"Miandrivazo, Madagascar (ZVA)",

"Middle Caicos, Turks and Caicos (MDS)",

"Midway Island, US Minor Outlying Islands (MDY)",

"Mikkeli, Finland (MIK)",

"Mikonos, Greece (JMK)",

"Milan, Italy - Orio Al Serio (BGY)",

"Milan, Italy - Linate (LIN)",

"Milan, Italy - Malpensa (MXP)",

"Milan, Italy - Parma (PMF)",

"Mildura, VI, Australia (MQL)",

"Mili Island, Marshall Islands (MIJ)",

"Milingimbi, NT, Australia (MGT)",

"Minami Daito, Japan (MMD)",

"Minatitla, Mexico (MTT)",

"Mindiptana, Indonesia (MDP)",

"Mineralnye Vody, Russia (MRV)",

"Minsk, Belarus - Minsk International 1 (MHP)",

"Minsk, Belarus - Minsk International 2 (MSQ)",

"Miri, Malaysia (MYY)",

"Mirnyj, Russia (MJZ)",

"Misawa, Japan (MSJ)",

"Misima Island, Papua New Guinea (MIS)",

"Misurata, Libya (MRA)",

"Mitiaro Island, Cook Islands (MOI)",

"MiyakeJima, Japan (MYE)",

"Miyako Jima, Japan (MMY)",

"Mizan Teferi, Ethiopia (MTF)",

"Mo I Rana, Norway (MQN)",

"Moa, Cuba (MOA)",

"Moala, Fiji (MFJ)",

"Moanamani, Indonesia (ONI)",

"Moanda, Congo (MNB)",

"Moanda, Gabon (MFF)",

"Mogadishu, Somalia (MGQ)",

"Mohenjodaro, Denmark (MJD)",

"Mokpo, South Korea (MPK)",

"Mokuti Lodge, Namibia (OKU)",

"Molde, Norway (MOL)",

"Mombasa, Kenya (MBA)",

"Monastir, Tunisia (MIR)",

"Monbetsu, Japan (MBE)",

"Monclova, Mexico (LOV)",

"Monkey Mia, WA, Australia (MJK)",

"Mono, Solomon Islands (MNY)",

"Monrovia, Liberia (ROB)",

"Monte Carlo, Monaco (MCM)",

"Monte Dourado, PA, Brazil (MEU)",

"Montego Bay, Jamaica (MBJ)",

"Monteria, Colombia (MTR)",

"Monterrey, Mexico (MTY)",

"Montes Claros, MG, Brazil (MOC)",

"Montevideo, Uruguay (MVD)",

"Montpellier, France (MPL)",

"Montserrat, Montserrat (MNI)",

"Moorea, French Polynesia (MOZ)",

"Mopti, Mali (MZI)",

"Mora, Sweden (MXX)",

"Morafenobe, Madagascar (TVA)",

"Morambe, Madagascar (MXM)",

"Moranbah, QL, Australia (MOV)",

"Moree, NS, Australia (MRZ)",

"Morelia, Mexico (MLM)",

"Morioka, Japan (HNA)",

"Mornington, QL, Australia (ONG)",

"Moro, Papua New Guinea (MXH)",

"Morondava, Madagascar (MOQ)",

"Moroni, Comoros (HAH)",

"Moruya, NS, Australia (MYA)",

"Moscow, Russia - all locations (MOW)",

"Moscow, Russia - Bykovo (BKA)",

"Moscow, Russia - Domodedovo (DME)",

"Moscow, Russia - Sheremetyevo (SVO)",

"Moscow, Russia - Vnukovo (VKO)",

"Mosjoen, Norway (MJF)",

"Mostar, Bosnia and Herzegovina (OMO)",

"Mota Lava, Vanuatu (MTV)",

"Mouila, Gabon (MJL)",

"Mount Cook, New Zealand (MON)",

"Mount Gambier, SA, Australia (MGB)",

"Mount Hagen, Papua New Guinea (HGU)",

"Mount Hotham, VI, Australia (MHU)",

"Mount Isa, Australia (ISA)",

"Mount Keith, WA, Australia (WME)",

"Mount Magnet, WA, Australia (MMG)",

"Mount Pleasant, Falkland Islands (MPN)",

"Mpacha, Namibia (MPA)",

"Mtwara, Tanzania (MYW)",

"Mucuri, BA, Brazil (MVS)",

"Mudanjiang, China (MDG)",

"Mudgee, Australia (DGE)",

"Muenster, Germany (FMO)",

"Mukan, Malaysia (MKM)",

"Mulhouse, France (MLH)",

"Mulia, Indonesia (LII)",

"Multan, Pakistan (MUX)",

"Mulu, Malaysia (MZV)",

"Mumbai, India (BOM)",

"Munda, Solomon Islands (MUA)",

"Munich, Germany (MUC)",

"Murcia, Spain (MJV)",

"Murmansk, Russia (MMK)",

"Murray Island, QL, Australia (MYI)",

"Mus, Turkey (MSR)",

"Muscat, Oman (MCT)",

"Musoma, Tanzania (MUZ)",

"Muzaffarabad, Pakistan (MFG)",

"Mwanza, Tanzania (MWZ)",

"Myeik, Myanmar (MGZ)",

"Myitkyina, Myanmar (MYT)",

"Mytilene, Greece (MJT)",

"Mzuzu, Malawi (ZZU)",

"Nabire, Indonesia (NBX)",

"Nacala, Mozambique (MNC)",

"Nadar, Morocco (NDR)",

"Nadi, Fiji (NAN)",

"Nadym, Russia (NYM)",

"Naga, Philippines (WNP)",

"Nagasaki, Japan (NGS)",

"Nagoya, Japan (NGO)",

"Nagpur, India (NAG)",

"Nairobi, Kenya - Jomo Kenyatta Intl (NBO)",

"Nairobi, Kenya - Wilson (WIL)",

"Nakhichevan, Azerbaijan (NAJ)",

"Nakhon Ratchosima, Thailand (NAK)",

"Nakhon Si Thammarat, Thailand (NST)",

"Nalchik, Russia (NAL)",

"Namangan, Uzbekistan (NMA)",

"Namatana, Papua New Guinea (ATN)",

"Namorik Island, Marshall Islands (NDK)",

"Nampula, Mozambique (APL)",

"Namsos, Norway (OSY)",

"Namudi, Papua New Guinea (NDI)",

"Nan, Thailand (NNT)",

"Nanchong, China (NAO)",

"Nanking/Nanjing, China (NKG)",

"Nanning, China (NNG)",

"Nanortalik, Greenland (JNN)",

"Nantes, France - Nantes Atlantique (NTE)",

"Nantes, France - Rail service (QJZ)",

"Nantong, China (NTG)",

"Nanyang, China (NNY)",

"Nanyuki, Kenya (NYK)",

"Napier-Hastings, New Zealand (NPE)",

"Naples, Italy (NAP)",

"Narathiwat, Thailand (NAW)",

"Narrabri, NS, Australia (NAA)",

"Narsaq, Greenland (JNS)",

"Narsarsuaq, Greenland (UAK)",

"Narvik, Norway (NVK)",

"Naryan-Mar, Russia (NNM)",

"Nassau, Bahamas - International (NAS)",

"Nassau, Bahamas - Paradise Island (PID)",

"Natadi, Congo (MAT)",

"Natal, RN, Brazil (NAT)",

"Nauru Island, Nauru (INU)",

"Navegantes, SC, Brazil (NVT)",

"Nawabshah, Pakistan (WNS)",

"NayUrengoy, Russia (NUX)",

"Ndola, Zambia (NLA)",

"Neerlerit Inaat, Greenland (CNP)",

"Nefteyugansk, Russia (NFG)",

"Neghelli, Ethiopia (EGL)",

"Negril, Jamaica (NEG)",

"Neiva, Colombia (NVA)",

"Nejran, Saudi Arabia (EAM)",

"Nelso, New Zealand (NSN)",

"Nelspruit, South Africa (NLP)",

"Nema, Mauritania (EMN)",

"Neryjungri, Russia (NER)",

"Neuquen, NE, Argentina (NQN)",

"Nevis, St. Kitts and Nevis (NEV)",

"New London/Groton (GON)",

"New Plymouth, New Zealand (NPL)",

"Newcastle, New South Wales, Australia - Belmont (BEO)",

"Newcastle, New South Wales, Australia (NTL)",

"Newcastle, United Kingdom (NCL)",

"Newman, WA, Australia (ZNE)",

"Newquay, United Kingdom (NQY)",

"Ngaoundere, Cameroon (NGE)",

"Ngau Island, Fiji (NGI)",

"Ngukurr, NT, Australia (RPM)",

"Nha Trang, Viet Nam (NHA)",

"Niamey, Niger (NIM)",

"Nice, France (NCE)",

"Nicosia, Cyprus (NIC)",

"Nimes, France (FNI)",

"Ningbo, China (NGB)",

"Nioko, Congo (NIX)",

"Niuafo\'ou, Tonga (NFO)",

"Niuatoputapu, Tonga (NTT)",

"Niue Island, Niue (IUE)",

"Nizhnevartovsk, Russia (NJC)",

"Nizhniy Novgorod, Russia (GOJ)",

"Nojabrxsk, Russia (NOJ)",

"Ndjamena, Chad (NDJ)",

"Norderney, Germany (NRD)",

"Nordholz-Speika, Germany (NDZ)",

"Norfolk Island, Norfolk Island (NLK)",

"Noril\'sk, Russia (NSK)",

"Normanton, QL, Australia (NTN)",

"Norrkoping, Sweden (NRK)",

"Norsup, Vanuatu (NUS)",

"North Caicos, Turks and Caicos Islands (NCA)",

"North Eleuthera, Bahamas (ELH)",

"North Ronaldsay, United Kingdom (NRL)",

"Norwich, United Kingdom (NWI)",

"Nosara Beach, Costa Rica (NOB)",

"Nossi-be, Madagascar (NOS)",

"Nottingham, United Kingdom (EMA)",

"Nouadhiba, Mauritania (NDB)",

"Nouakchott, Mauritania (NKC)",

"Noumea, New Caledonia - Tontouta (NOU)",

"Noumea, New Caledonia - Magenta (GEA)",

"Novgorod, Russia (NVR)",

"Novokuznetsk, Russia (NOZ)",

"Novosibirsk, Russia - Tolmachevo (OVB)",

"Nueva Gerona, Cuba (GER)",

"Nuevo Laredo, Mexico (NLD)",

"Nuku Hiva, French Polynesia (NHV)",

"Nuku\'Alofa, Tonga (TBU)",

"Nukus, Uzbekistan (NCU)",

"Numbulwar, NT, Australia (NUB)",

"Nunukan, Indonesia (NNX)",

"Nuremberg, Germany - Rail service (ZAQ)",

"Nuremberg, Germany (NUE)",

"Nuuk, Greenland (GOH)",

"Nyala, Sudan (UYL)",

"Nyaung, Myanmar (NYU)",

"Nyngan, NS, Australia (NYN)",

"Oaxaca, Mexico (OAX)",

"Obano, Indonesia (OBD)",

"Obihiro, Japan (OBO)",

"Ocho Rios, Jamaica (OCJ)",

"Odense, Denmark (ZBQ)",

"Odessa, Ukraine (ODS)",

"Ohrid, Macedonia (OHD)",

"Oita, Japan (OIT)",

"Okaba, Indonedia (OKQ)",

"Okayama, Japan (OKJ)",

"Okhotsk, Russia (OHO)",

"Okinawa, Japan (OKA)",

"Okoshiri, Japan (OIR)",

"Oksibil, Indonesia (OKL)",

"Olbia, Italy (OLB)",

"Olpoi, Vanuatu (OLJ)",

"Olympic Dam, SA, Australia (OLP)",

"Omboue, Gabon (OMB)",

"Omsk, Russia (OMS)",

"Ondangwa, Namibia (OND)",

"Oradea, Romania (OMR)",

"Oran, Algeria (ORN)",

"Orange, New South Wales, Australia (OAG)",

"Oranjemund, Namibia (OMD)",

"Orebro, Sweeden - Obrebro-Bofors (ORB)",

"Orenburg, Russia (REN)",

"Ormara, Pakistan (ORW)",

"Ornskoldsvik, Sweden (OER)",

"Orsk, Russia (OSW)",

"Orsta-Volda, Norway (HOV)",

"Osaka, Japan - all airports (OSA)",

"Osaka, Japan - Itami (ITM)",

"Osaka, Japan - Kansai Intl (KIX)",

"Oshima, Japan (OIM)",

"Osijek, Croatia (OSI)",

"Oskarshamn, Sweden (OSK)",

"Oslo, Norway (OSL)",

"Oslo, Norway - Sandefjord (TRF)",

"Ostersund, Sweden (OSD)",

"Ostrava, Czech Republic (OSR)",

"Otu, Colombia (OTU)",

"Ouagadougou, Burkina Faso (OUA)",

"Ouargla, Algeria (OGX)",

"Ouarzazate, Morocco (OZZ)",

"Oudomxay, Laos (ODY)",

"Oujda, Morocco (OUD)",

"Oulu, Finland (OUL)",

"Ouvea, New Caledonia (UVE)",

"Ovda, Israel (VDA)",

"Oyem, Gabon (OYE)",

"Paama, Vanuatu (PBJ)",

"Paamiut, Greenland (JFR)",

"Padang, Indonesia (PDG)",

"Paderborn, Germany (PAD)",

"Pago Pago, American Samoa (PPG)",

"Pakse, Laos (PKZ)",

"Pakuba, Uganda (PAF)",

"Palacios, Honduras (PCH)",

"Palang Karaya, Indonesia (PKY)",

"Palanga, Lithuania (PLQ)",

"Palembang, Indonesia (PLM)",

"Palenque, Mexico (PQM)",

"Palermo, Sicily, Italy (PMO)",

"Palma Mallorca, Spain and Canary Islands (PMI)",

"Palmar, Costa Rica (PMZ)",

"Palmas, TO, Brazil (PMW)",

"Palmerston North, New Zealand (PMR)",

"Palu, Indonesia (PLW)",

"Pamplona, Spain (PNA)",

"Panama City, Panama - Tocumen Intl (PTY)",

"Panama City, Panama - Paitilla (PAC)",

"Pangkalanboun, Indonesia (PKN)",

"Pangkalpinang, Indonesia (PGK)",

"Panjger, Pakistan (PJG)",

"Pantelleria, Italy (PNL)",

"Papa Westray, United Kingdom (PPW)",

"Papeete, French Polynesia (PPT)",

"Paphos, Cyprus (PFO)",

"Para Chinar, Pakistan (PAJ)",

"Paraburdoo, WA, Australia (PBO)",

"Paradise Island, Bahamas (PID)",

"Paramaribo, Suriname - Zanderij Intl (PBM)",

"Paramaribo, Suriname - Zorg En Hoop (ORG)",

"Parana, ER, Argentina (PRA)",

"Parasi, Solomon Islands (PRS)",

"Paris, France - All airports (PAR)",

"Paris, France - Charles Degaulle (CDG)",

"Paris, France - Orly (ORY)",

"Paris, France - Beauvais-Tille (BVA)",

"Parma/Milan, Italy (PMF)",

"Parnaiba, PI, Brazil (PHB)",

"Paro, Bhutan (PBH)",

"Pasni, Pakistan (PSI)",

"Paso de Los Libres, Argentina (AOL)",

"Passo Fundo, RS, Brazil (PFB)",

"Pasto, Colombia (PSO)",

"Patna, India (PAT)",

"Patras, Greece (GPA)",

"Pau, France (PUF)",

"Pavlodar, Kazakhstan (PWQ)",

"Pechora, Russia (PEX)",

"Pekanbaru, Indonesia (PKU)",

"Pelotas, RS, Brazil (PET)",

"Pemba, Mozambique (POL)",

"Pemba, Tanzania - Wawi (PMA)",

"Penang, Malaysia (PEN)",

"Penrhyn Island, Cook Islands (PYE)",

"Penzance, United Kingdom (PZE)",

"Pereira, Colombia (PEI)",

"Perigueux, France (PGX)",

"Perito Moreno, SC, Argentina (PMQ)",

"Perm, Russia (PEE)",

"Perpignan, France (PGF)",

"Perth, Western Australia, Australia (PER)",

"Perugia, Italy (PEG)",

"Pescara, Italy (PSR)",

"Peshawar, Pakistan (PEW)",

"Petrolina, PE, Brazil (PNZ)",

"Petropaulousk-Kamchats, Russia (PKC)",

"Petrozavodsk, Russia (PES)",

"Phalaborwa, South Africa (PHW)",

"Phitsanulok, Thailand (PHS)",

"Phnom Penh, Cambodia (PNH)",

"Phrae, Thailand (PRH)",

"Phu Quoc, Viet Nam - Duong Dang (PQC)",

"Phuket, Thailand (HKT)",

"Pico Island, Portugal (PIX)",

"Piedras Negras, Mexico (PDS)",

"Pietermaritzburg, South Africa (PZB)",

"Pietersburb, South Africa (PTG)",

"Pingtung, Taiwan (PIF)",

"Pisa, Italy - Gal Galilei (PSA)",

"Pituffik, Greenland (THU)",

"Piura, Peru (PIU)",

"Placencia, Belize (PLJ)",

"Pleiku, Viet Nam (PXU)",

"Plettenburg Bay, South Africa (PBZ)",

"Plymouth, United Kingdom (PLH)",

"Podgoriea, Serbia and Montenegro - Golubovci (TGD)",

"Pohnpei, Micronesia (PNI)",

"Pointe Noire, Congo (PNR)",

"Pointe-a-Pitre, Guadeloupe (PTP)",

"Poitiers, France - Biard (PIS)",

"Poitiers, France - Rail service (XOP)",

"Pokhara, Nepal (PKR)",

"Poltava, Ukraine (PLV)",

"Polyarnyj, Russia (PYJ)",

"Ponce, Puerto Rico (PSE)",

"Ponta Delgada, Portugal (PDL)",

"Ponta Pora, MS, Brazil (PMG)",

"Pontianak, Indonesia (PNK)",

"Popondetta, Papua New Guinea (PNP)",

"Popraol/Tatry, Slovakia (TAT)",

"Porbandar, India (PBD)",

"Pori, Finland (POR)",

"Porlamar, Venezuela (PMV)",

"Port Antonio, Jamaica (POT)",

"Port Au Prince, Haiti (PAP)",

"Port Augusta, SA, Australia (PUG)",

"Port Berge, Madagascar (WPB)",

"Port Blair, India (IXZ)",

"Port Elizabeth, South Africa (PLZ)",

"Port Gentil, Gabon (POG)",

"Port Harcourt, Nigeria (PHC)",

"Port Headland, WA, Australia (PHE)",

"Port Lincoln, SA, Australia (PLO)",

"Port Macquarie, NS, Australia (PQQ)",

"Port Moresby, Papua New Guinea (POM)",

"Port of Spain, Trinidad (POS)",

"Port Stanley, Falkland Islands (PSY)",

"Port Sudan, Sudan (PZU)",

"Port Vila, Vanuatu (VLI)",

"Portland, VI, Australia (PTJ)",

"Porto Alegre, RS, Brazil (POA)",

"Porto Santo, Portugal (PXO)",

"Porto Seguro, Brazil (BPS)",

"Porto Velho, RO, Brazil (PVH)",

"Porto, Portugal (OPO)",

"Portoviejo, Ecuador (PVO)",

"Posadas, MI, Argentina (PSS)",

"Poza Rico, Mexico (PAZ)",

"Poznan, Poland (POZ)",

"Prague, Czech Republic (PRG)",

"Praia, Cape Verde (RAI)",

"Pres. Roque Saenz Pena, CH, Argentina (PRQ)",

"Presidente Prudente, SP, Brazil (PPB)",

"Preveza/Lefkas, Greece (PVK)",

"Pristina, Serbia and Montenegro (PRN)",

"Proserpine, QL, Australia (PPP)",

"Providenciales, Turks and Caicos Islands (PLS)",

"Pucallpa, Peru (PCL)",

"Puebla, Mexico (PBC)",

"Puerto Ayacucha, Venezuela (PYH)",

"Puerto Berria, Colombia (PBE)",

"Puerto del Rosario, Spain (FUE)",

"Puerto Deseado, SC, Argentina (PUD)",

"Puerto Escondido, Mexico (PXM)",

"Puerto Jimenez, Costa Rica (PJM)",

"Puerto Lempira, Honduras (PEU)",

"Puerto Madryn, CB, Argentina (PMY)",

"Puerto Maldonado, Peru (PEM)",

"Puerto Montt, Chile (PMC)",

"Puerto Ordaz, Venezuela (PZO)",

"Puerto Plata, Dominican Republic (POP)",

"Puerto Princesa, Philippines (PPS)",

"Puerto Suarez, Bolivia (PSZ)",

"Puerto Vallarta, Mexico (PVR)",

"Pula, Croatia (PUY)",

"Pune, India (PNQ)",

"Punta Arenas, Chile (PUQ)",

"Punta Cana, Dominican Republic (PUJ)",

"Punta Del Este, Uruguay (PDP)",

"Punta Gorda, Belize (PND)",

"Punta Islita, Costa Rica (PBP)",

"Puttaparthi, India (PUT)",

"Putussibau, Indonesia (PSU)",

"Pyongyang, North Korea (FNJ)",

"Qaisumah, Saudi Arabia (AQI)",

"Qaqortoq, Greenland (JJU)",

"Qiemo, China (IQM)",

"Qingdao, China (TAO)",

"Qiqihar, China (NDG)",

"Queenstown, New Zealand (ZQN)",

"Quelimane, Mozambique (UEL)",

"Quepos, Costa Rica (XQP)",

"Queretaro, Mexico (QRO)",

"Quetta, Pakistan (UET)",

"Qui Nhon, Viet Nam (UIH)",

"Quibdo, Colombia (UIB)",

"Quimper, France (UIP)",

"Quipi, QL, Australia (ULP)",

"Quito, Ecuador (UIO)",

"Rabaraba, Papua New Guinea (RBP)",

"Rabat, Morocco (RBA)",

"Rabaul, Papua New Guinea (RAB)",

"Rach Gia, Viet Nam (VKG)",

"Raduzhnyi, Russia (RAT)",

"Rafha, Saudi Arabia (RAH)",

"Rafsanjan, Iran (RJN)",

"Raiatea, French Polynesia (RFP)",

"Rajkot, India (RAJ)",

"Rajshahi, Bangladesh (RJH)",

"Ramato, Solomon Islands (RBV)",

"Ramingining, NT, Australia (RAM)",

"Ranchi, India (IXR)",

"Ranong, Thailand (UNN)",

"Rarotonga, Cook Islands (RAR)",

"Ras Al Khaimah, United Arab Emirates (RKT)",

"Rasht, Iran (RAS)",

"Ratanakiri, Cambodia (RBE)",

"Rawala Kot, Pakistan (RAZ)",

"Rebun, Japan (RBJ)",

"Recife, PE, Brazil (REC)",

"Reconquista, SF, Argentina (RCQ)",

"Reggio Calabria, Italy (REG)",

"Rennell, Solomon Islands (RNL)",

"Rennes, France (RNS)",

"Resistencia, CW, Argentina (RES)",

"Reus, Spain and Canary Islands (REU)",

"Reykjavik, Iceland (KEF)",

"Reynossa, Mexico (REX)",

"Rhodes, Gabon (RHO)",

"Ribeirao Preto, SP, Brazil (RAO)",

"Riberalta, Bolivia (RIB)",

"Richards Bay, South Africa (RCB)",

"Richmond, QL, Australia (RCM)",

"Riga, Latvia (RIX)",

"Rijeka, Croatia (RJK)",

"Rimini, Italy (RMI)",

"Rio Branco, AC, Brazil (RBR)",

"Rio Cuarto, CD, Argentina (RCU)",

"Rio De Janeiro, RJ, Brazil (GIG)",

"Rio Gallegos, Argentina - Internacional (RGL)",

"Rio Grande, RS, Brazil (RIG)",

"Rio Grande, TF, Argentina (RGA)",

"Rio Mayo, CB, Argentina (ROY)",

"Rio Verde, GO, Brazil (RVD)",

"Riohacha, Colombia (RCH)",

"Rishiri, Japan (RIS)",

"Riyadh, Saudi Arabia (RUH)",

"Riyan Mukalla, Yemen (RIY)",

"Roane, France (RNE)",

"Roatan, Honduras (RTB)",

"Roch Gia, Viet Nam (VKG)",

"Rock Sound, Bahamas (RSD)",

"Rockhampton, QL, Australia (ROK)",

"Rodez, France (RDZ)",

"Rodrigues Island, Mauritius (RRG)",

"Roervik, Norway (RVK)",

"Rognan, Norway (ZXM)",

"Roma, QL, Australia (RMA)",

"Rome, Italy - All airports (ROM)",

"Rome, Italy - Ciampino (CIA)",

"Rome, Italy - Leonardo Da Vinci/Fiumicino (FCO)",

"Rongelap Island, Marshall Islands (RNP)",

"Ronneby, Sweden (RNB)",

"Roros, Norway (RRS)",

"Rorutu, French Polynesia (RUR)",

"Rosario, SF, Argentina (ROS)",

"Rosh Pina, Iceland (RPN)",

"Rost, Norway (RET)",

"Rostock-Laage, Germany (RLG)",

"Rostov, Russia (ROV)",

"Rota, Northern Mariana Islands (ROP)",

"Rotorua, New Zealand (ROT)",

"Rotterdam, Netherlands (RTM)",

"Rouen, France (URO)",

"Rovaniemi, Finland (RVN)",

"S. Cristobal del Casas, Mexico (SZT)",

"Saarbruecken, Germany (QFZ)",

"Saint Croix, U.S. Virgin Islands (STX)",

"Saint Lucia, ST. LUCIA (SLU)",

"Saint Maarten, Netherlands Antilles (SXM)",

"Saint Petersburg, Russia - Pulkovo (LED)",

"Saint Thomas, U.S. Virgin Islands (STT)",

"Saint Tropez, France - La Mole (LTT)",

"Saint Tropez, France (XPZ)",

"Saipan, Northern Mariana Islands (SPN)",

"Sakon Nakhon, Thailand (SNO)",

"Salehard, Russia (SLY)",

"Salt Cay, Turks and Caicos Islands (SLX)",

"Saltillo, Mexico (SLW)",

"Salvadore, BA, Brazil (SSA)",

"Salzburg, Austria (SZG)",

"Samara, Russia (KUF)",

"Sambaua, Madagascar (SVB)",

"Samburu, Kenya (UAS)",

"Samos, Greece (SMI)",

"San Andres Island, Colombia (ADZ)",

"San Antonio Oesta, RN, Argentina (OES)",

"San Antonio, Venezuela (SVZ)",

"San Carlos, Argentina (BRC)",

"San Jose, Costa Rica - Juan Santa Maria (SJO)",

"San Jose, Costa Rica - Tobias Bolanos Int\'l (SYQ)",

"San Juan, Puerto Rico (SJU)",

"San Juan, SJ, Argentina (UAQ)",

"San Julian, SC, Argentina (ULA)",

"San Luis Potosi, Mexico (SLP)",

"San Luis, SL, Argentina (LUQ)",

"San Marino, San Marino (SAI)",

"San Martin De Los Andes, Argentina (CPC)",

"San Miguel, Panama (NMG)",

"San Pedro Sula, Honduras (SAP)",

"San Rafael, Argentina (AFA)",

"San Salvador, Bahamas (ZSA)",

"San Salvador, El Salvador (SAL)",

"San Sebastian, Spain (EAS)",

"Sana\'a, Yemen (SAH)",

"Sanday, United Kingdom (NDY)",

"Santa Ana, Solomon Islands (NNB)",

"Santa Barbara, Ed, Venezuela (STB)",

"Santa Cruz De La Palma, Spain and Canary Islands - La Palma (SPC)",

"Santa Cruz, Bolivia (VVI)",

"Santa Maria, Brazil (RIA)",

"Santa Maria, Portugal (SMA)",

"Santa Marta, Colombia (SMR)",

"Santa Rosa, LP, Argentina (RSA)",

"Santarem, PA, Brazil (STM)",

"Sante Marie, Madagascar (SMS)",

"Santiago, Chile (SCL)",

"Santiago, Dominican Republic (STI)",

"Santo Angelo, Brazil (GEL)",

"Santo Antao, Cape Verde (NTO)",

"Santo Domingo, Dominican Republic - Herrera (HEX)",

"Santo Domingo, Dominican Republic - Las Americas (SDQ)",

"Santo Domingo, Venezuela (STD)",

"Sanya, China (SYX)",

"Sao Nicolau, Cape Verde (SNE)",

"Sao Paulo, Brazil - Congonhas (CGH)",

"Sao Paulo, Brazil - Viracopos (VCP)",

"Sao Paulo, Brazil - Guarulhos Intl (GRU)",

"Sao Tome Is., Sao Tome and Principe (TMS)",

"Sao Vicente, Cape Verde (VXE)",

"Sapporo, Japan - Chitose (CTS)",

"Sapporo, Japan - Okadama (OKD)",

"Sara, Vanuatu (SSR)",

"Saratov, Russia (RTW)",

"Sarmi, Indonesia (ZRM)",

"Satu Mare, Romania (SUJ)",

"Satwag, Papua New Guinea (SWG)",

"Sau Luiz, MA, Brazil (SLZ)",

"Saumlaki, Indonesia (SXK)",

"Savannakhet, Laos (ZVK)",

"Savonlinna, Finland (SVL)",

"Savusavu, Fiji (SVU)",

"Sayaboury, Laos (ZBY)",

"Sege, Solomon Islands (EGM)",

"Seiyun, Yemen (GXF)",

"Selje, Norway (QFK)",

"Semarang, Indonesia (SRG)",

"Senggo, Indonesia (ZEG)",

"Seoul, South Korea - All Airports (SEL)",

"Seoul, South Korea - Gimpo International (GMP)",

"Seoul, South Korea - Incheon International (ICN)",

"Servi, Indonesia (ZRI)",

"Sesriem, Namibia (SZM)",

"Sevilla, Spain and Canary Islands (SVQ)",

"Shanghai, China (PVG)",

"Shannon, Ireland (SNN)",

"Shantou, China (SWA)",

"Sharm El Sheikh, Egypt (SSH)",

"Sheffield, United Kingdom (SZD)",

"Shenzhen, China (SZX)",

"Shetland Islands, United Kingdom - Lerwick/Tingwall (LWK)",

"Shetland Islands, United Kingdom - Sumburgh (LSI)",

"Shillavo, Ethiopia (HIL)",

"Shimkent, Kazakhstan (CIT)",

"Shiraz, Iran (SYZ)",

"Shonai, Japan (SYO)",

"Shute Harbor, Australia (JHQ)",

"Siem Reap, Cambodia (REP)",

"Silchar, India (IXS)",

"Simao, China (SYM)",

"Sinak, Indonesia (NKD)",

"Singapore, Singapore - Changi (SIN)",

"Singapore, Singapore - Seletar (XSP)",

"Sintang, Indonesia (SQG)",

"Sisimiut, Greenland (JHS)",

"Sittwe, Myanmar (AKY)",

"Sivas, Turkey (VAS)",

"Skiathos, Greece (JSI)",

"Skopie, Macedonia (FYROM) (SKP)",

"Skovde, Sweden (KVB)",

"Skukuza, South Africa (SZK)",

"Sligo, Ireland (SXL)",

"Soalala, Madagascar (DWB)",

"Soderham, Sweden (SOO)",

"Sofia, Bulgaria (SOF)",

"Sognolal, Norway (SOG)",

"Solo City, Indonesia (SOC)",

"Son-La, Viet Nam - Na-San (SQH)",

"Sorkjosen, Norway (SOJ)",

"Sorocaba, Brazil (SOD)",

"South Andros, Bahamas (TZN)",

"South Caicos, Turks and Caicos Islands (XSC)",

"South Hampton, United Kingdom (SOU)",

"South Molle Island, QL, Australia (SOI)",

"Split, Croatia (SPU)",

"Spring Point, Bahamas (AXP)",

"Srinagar, India (SXR)",

"St. Croix Island, U.S. Virgin Islands (STX)",

"St Denis de la Reunion, Reunion (RUN)",

"St Kitts, St Kitts and Nevis (SKB)",

"St Pierre, St Pierre and Miquelon (FSP)",

"St Vincent, Saint Vincent and the Grenadines (SVD)",

"St. Etienne, France (EBU)",

"St. Eustatius, Netherlands Antilles (EUX)",

"St. Lucia, St. Lucia - Hawnorra (UVF)",

"St. Lucia, St. Lucia (UVF)",

"St. Petersburg, Russia (LED)",

"St. Pierre de la Reunion, Reunion (ZSE)",

"St. Thomas Island, U.S. Virgin Islands (STT)",

"Stavropol, Russia (STW)",

"Stavanger, Norway (SVG)",

"Stella Maris, Bahamas (SML)",

"Stockholm, Sweden - All airports (STO)",

"Stockholm, Sweden - Arlanda (ARN)",

"Stockholm, Sweden - Bromma (BMA)",

"Stornoway, United Kingdom (SYY)",

"Storuman, Sweden (SQO)",

"Strasbourg, France - Bus service (XER)",

"Strasbourg, France - Entzheim (SXB)",

"Stronsay, United Kingdom (SOY)",

"Stung Treng, Cambodia (TNX)",

"Stuttgart, Germany - Echterdingen (STR)",

"Stuttgart, Germany - Rail service (ZWS)",

"Suavanao, Solomon Islands (VAO)",

"Sucre, Bolivia (SRE)",

"Sue Island, QL, Australia (SYU)",

"Sui, Pakistan (SUL)",

"Sukhotthai, Thailand (THS)",

"Sun City, South Africa (NTY)",

"Sunshine Coast, QL, Australia (MCY)",

"Surabaya, Indonesia (SUB)",

"Surat Thani, Thailand (URT)",

"Suva, Fiji (SUV)",

"Sveg, Sweden (EVG)",

"Svolvaer, Norway (SVJ)",

"Sydney, New South Wales, Australia (SYD)",

"Sylhet, Bangladesh (ZYL)",

"Szczecin, Poland (SZZ)",

"Taba, Egypt (TCP)",

"Tabarka, Tunisia (TBJ)",

"Tabatinga, AM, Brazil (TBT)",

"Tabora, Tanzania (TBO)",

"Tabriz, Iran (TBZ)",

"Tabubil, Papua New Guinea (TBG)",

"Tabuk, Saudi Arabia (TUU)",

"Tacheng, China (TCG)",

"Tachilek, Myanmar (THL)",

"Tacloban, Philippines (TAC)",

"Tacna, Peru (TCQ)",

"Taichung, Taiwan (TXG)",

"Taif, Saudi Arabia (TIF)",

"Tainan, Taiwan (TNN)",

"Taipei, Taiwan - Sung Shan (TSA)",

"Taipei, Taiwan - Chiang Kai Shek (TPE)",

"Taitung, Taiwan (TTT)",

"Taiyuan, China (TYN)",

"Taiz, Yemen (TAI)",

"Tallinn, Estonia (TLL)",

"Tamanrasset, Algeria (TMR)",

"Tamarindo, Costa Rica (TNO)",

"Tamatave, Madagascar (TMM)",

"Tambohorano, Madagascar(WTA)",

"Tambolaka, Indonesia (TMC)",

"Tambor, Costa Rica (TMU)",

"Tampere, Finland (TMP)",

"Tampico, Mexico (TAM)",

"Tamworth, NS, Australia (TMW)",

"Tanahmerah, Indonesia (TMH)",

"Tangier, Morocco (TNG)",

"Tanjung Pandan, Indonesia (TJQ)",

"Tanjung Selor, Indonesia (TJS)",

"Tanna, Vanuatu (TAH)",

"Tapachula, Mexico (TAP)",

"Tarakan, Indonesia (TRK)",

"Taramajma, Japan (TRA)",

"Taranto, Italy (TAR)",

"Tarapoto, Peru (TPP)",

"Tarawa, Kiribati (TRW)",

"Taree, NS, Australia (TRO)",

"Tari, Papua New Guinea (TIZ)",

"Tarija, Bolivia (TJA)",

"Tashkent, Uzbekistan (TAS)",

"Taupo, New Zealand (TUO)",

"Tauranga, New Zealand (TRG)",

"Taveuni, Fiji (TVU)",

"Tawau, Malaysia (TWU)",

"Tbessa, Algeria (TEE)",

"Tbilisi, Georgia (TBS)",

"Tchibanga, Gabon (TCH)",

"Te Anau, New Zealand (TEU)",

"Teesside, United Kingdom (MME)",

"Tefe, AM, Brazil (TFF)",

"Tegucigalpa, Honduras (TGU)",

"Tehran, Iran - Mehrabad (THR)",

"Tekadu, Papua New Guinea (TKB)",

"Tel Aviv, Israel (TLV)",

"Tembagapura, Indonesia (TIM)",

"Teminabuan, Indonesia (TXM)",

"Temuco, Chile (ZCO)",

"Tenerife, Spain and Canary Islands - Norte Los Rodeos (TFN)",

"Tenerife, Spain and the Canary Islands - Sur Reina Sofia (TFS)",

"Tennant Creek, NT, Australia (TCA)",

"Tepic, Mexico (TPQ)",

"Terceira Island, Portugal (TER)",

"Teresina, PI, Brazil (THE)",

"Termez, Uzbekistan (TMJ)",

"Ternate, Indonesia (TTE)",

"Tetabedi, Papua New Guinea (TDB)",

"Tete, Mozambique (TET)",

"Tetuan, Morocco (TTU)",

"Tezpur, India (TEZ)",

"Thandwe, Myanmar (SNW)",

"Thangool, QL, Australia (THG)",

"Thargomindah, QL, Australia (XTG)",

"The Bight, Bahamas (TBI)",

"Thessaloniki, Greece (SKG)",

"Thira, Greece (JTR)",

"Thiruvananthapuram, India (TRV)",

"Thorshofn, Iceland (THO)",

"Thursday Island, QL, Australia (TIS)",

"Tianjn, China (TSN)",

"Tiaret, Algeria (TID)",

"Tiga, New Caledonia (TGJ)",

"Tijuana, Mexico (TIJ)",

"Tikehau Atoll, French Polynesia (TIH)",

"Tiksi, Russia (IKS)",

"Timaru, New Zealand (TIU)",

"Timimoun, Algeria (TMX)",

"Timosoara, Romania (TSR)",

"Tindouf, Algeria (TIN)",

"Tinian, Northern Mariana Islands (TIQ)",

"Tioljikja, Mauritania (TIY)",

"Tioman, Malaysia (TOD)",

"Tippi, Ethiopia (TIE)",

"Tirana, Albania (TIA)",

"Tiree, United Kingdom (TRE)",

"Tirgu Mures, Romania (TGM)",

"Tiruchirapally, India (TRZ)",

"Tirupati, India (TIR)",

"Tivat, Serbia and Montenegro (TIV)",

"Tlemcen, Algeria (TLM)",

"Tobago, Trinidad and Tobago (TAB)",

"Tobruk, Libya (TOB)",

"Tokunoshima, Japan (TKN)",

"Tokushima, Japan (TKS)",

"Tokyo, Japan - All airports (TYO)",

"Tokyo, Japan - Haneda (HND)",

"Tokyo, Japan - Narita (NRT)",

"Toledo, PR, Brazil (TOW)",

"Toluco, Mexico (TLC)",

"Tom Price, WA, Australia (TPR)",

"Tomanggong, Malaysia (TMG)",

"Tombouctou, Mali (TOM)",

"Tomsk, Russia (TOF)",

"Tongliao, China (TGO)",

"Tongoa, Vanuatu (TGH)",

"Toowoomba, QL, Australia (TWB)",

"Torreon, Mexico (TRC)",

"Torres, Vanuatu (TOH)",

"Torsby, Sweden (TYF)",

"Tortola, British Virgin Islands (TOV)",

"Tortoli, Italy (TTB)",

"Tortuquero, Costa Rica (TTQ)",

"Tottori, Japan (TTJ)",

"Touho, New Caledonia (TOU)",

"Toulon, France (TLN)",

"Toulouse, France (TLS)",

"Tours, France (TUF)",

"Tours, France - Rail service (XSH)",

"Townsville, QL, Australia (TSV)",

"Toyama, Japan (TOY)",

"Tozeur, Tunisia (TOE)",

"Trabzon, Turkey (TZX)",

"Trang, Thailand (TST)",

"Trapani, Italy (TPS)",

"Traralgon, VI, Australia (TGN)",

"Treasure Cay, Bahamas (TCB)",

"Trelew, CB, Argentina (REL)",

"Trieste, Italy (TRS)",

"Trinidad, Bolivia (TDD)",

"Trinidad, Trinidad and Tobago (POS)",

"Tripoli, Latvia (TIP)",

"Trollhattan, Sweden (THN)",

"Trombetas, PA, Brazil (TMT)",

"Tromso, Norway (TOS)",

"Trondheim, Norway (TRD)",

"Trujillo, Honduras (TJI)",

"Trujillo, Peru (TRU)",

"Truk, Micronesia (TKK)",

"Tsaratanana, Madagascar (TTS)",

"Tsiroanomandidy, Madagascar (WTS)",

"Tsumeb, Namibia (TSB)",

"Tsushima, Japan (TSJ)",

"Tubuai, French Polynesia (TUB)",

"Tucuman, TU, Argentina (TUC)",

"Tucupita, Venezuela (TUV)",

"Tucurui, PA, Brazil (TUR)",

"Tufi, Papua New Guinea (TFI)",

"Tuguegarao, Philippines (TUG)",

"Tulcan, Ecuador (TUA)",

"Tulear, Madagascar (TLE)",

"Tum, Ethiopia (TUJ)",

"Tumaco, Colombia (TCO)",

"Tumbes, Peru (TBP)",

"Tunis, Tunisia (TUN)",

"Tunxi, China (TXN)",

"Turaif, Saudi Arabia (TUI)",

"Turbat, Pakistan (TUK)",

"Turin, Italy (TRN)",

"Turku, Finland (TKU)",

"Tuxtla Gutierrez, Mexico (TGZ)",

"Tyumen, Russia (TJM)",

"Ube, Japan (UBJ)",

"Uberaba, MG, Brazil (UBA)",

"Uberlandia, MG, Brazil (UDI)",

"Ubon Ratchathani, Thailand (UBP)",

"Udaipur, Indonesia (UDR)",

"Udon Thani, Thailand (UTH)",

"Ufa, Russia (UFA)",

"Ujae Island, Marshall Islands (UJE)",

"Ujung Pandang, Indonesia (UPG)",

"Ukhta, Russia (UCT)",

"Ulaanbaatar, Mongolia (ULN)",

"Ulanhot, China (HLH)",

"Ulan-Ude, Russia (UUD)",

"Ulei, Vanuatu (ULB)",

"Uliastai, Mongolia (ULY)",

"Ulithi, Micronesia (ULI)",

"Ulsan, South Korea (USN)",

"Ulundi, South Africa (ULD)",

"Umea, Sweden (UME)",

"Umtata, South Africa (UTT)",

"Upernavik, Greenland (JUV)",

"Upington, South Africa (UTN)",

"Uraj, Russia (URJ)",

"Uralsk, Kazakhstan (URA)",

"Urgench, Uzbekistan (UGC)",

"Urmieh, Iran (OMH)",

"Uroubi, Papua New Guinea (URU)",

"Uruapan, Mexico (UPN)",

"Uruguaiana, RS, Brazil (URG)",

"Urumqi, China (URC)",

"Useless Loop, WA, Australia (USL)",

"Ushuaia, TF, Argentina (USH)",

"Usinsk, Russia (USK)",

"Ust-Kamenogorsk, Kazakhstan (UKK)",

"Ust-Ilimsk, Russia (UIK)",

"Utapao, Thailand (UTP)",

"Utila, Honduras (UII)",

"Utirik Island, Marshall Islands (UTK)",

"Uummannaq, Greeland (UMD)",

"Uzhgorod, Ukraine (UDJ)",

"Vaasa, Finland (VAA)",

"Vadodara, India (BDQ)",

"Vadso, Norway (VDS)",

"Valdivia, Chile (ZAL)",

"Valencia, Spain (VLC)",

"Valencia, Venezuela (VLN)",

"Valenciennes, France (XVS)",

"Valera, Venezuela (VLV)",

"Valesdir, Vanuatu (VLS)",

"Valladolid, Spain and Canary Islands (VLL)",

"Valledupar, Colombia (VUP)",

"Valverde, Spain and Canary Islands - Hierro (VDE)",

"Van, Turkey (VAN)",

"Vancouver, BC (YVR)",

"Vanimo, Papua New Guinea (VAI)",

"Vanuabalavu, Fiji (VBV)",

"Varanasi, India (VNS)",

"Vardoe, Norway (VAW)",

"Varginha, MG, Brazil (VAG)",

"Varkaus, Finland (VRK)",

"Varna, Bulgaria (VAR)",

"Vasteras, Sweden (VST)",

"Vatomatry, Madagascar (VAT)",

"Vava\'u, Tonga (VAV)",

"Vaxjo, Sweden (VXO)",

"V.C. Bird International, Antigua & Barbuda (ANU)",

"Venice, Italy - Marco Polo (VCE)",

"Venice, Italy - Treviso (TSF)",

"Veracruz, Mexico (VER)",

"Varadero, Cuba (VRA)",

"Verona, Italy (VRN)",

"Vestmannaeyjar, Iceland (VEY)",

"Victoria Falls, Zimbabwe (VFA)",

"Victoria River Downs, NT, Australia (VCD)",

"Viedma, RN, Argentina (VDM)",

"Vienna, Austria (VIE)",

"Vientiane, Laos - Wattay (VTE)",

"Vieques, Puerto Rico (VQS)",

"Vigo, Spain (VGO)",

"Vilanculos, Mozambique (VNX)",

"Vilhelmina, Sweden (VHM)",

"Vilhena, Brazil (BVH)",

"Villa Gesell, BA, Argentina (VLG)",

"Villa Mercedes, SL, Argentina (VME)",

"Villahermosa, Mexico (VSA)",

"Vilnius, Lithuania (VNO)",

"Vinh City, Viet Nam (VII)",

"Virgin Gorda, British Virgin Islands (VIJ)",

"Visby, Sweden (VBY)",

"Vishakhapatnam, India (VTZ)",

"Vitebsk, Belarus (VTB)",

"Vitoria da Conquista, BA, Brazil (VDC)",

"Vitoria, Spain and Canary Islands (VIT)",

"Vivigani, Papua New Guinea (VIV)",

"Vladikavkaz, Russia (OGZ)",

"Vladivostok, Russia (VVO)",

"Vohemar, Madagascar (VOH)",

"Volgodonsk, Russia (VLK)",

"Volgograd, Russia (VOG)",

"Vopnafjordur, Iceland (VPN)",

"Vorkuta, Russia (VKT)",

"Voronezh, Russia (VOZ)",

"Wadi Ad Dawasir, Saudi Arabia (WAE)",

"Wadi Halfa, Sudan (WHF)",

"Wagethe, Indonesia (WET)",

"Wagga Wagga, NS, Australia (WGA)",

"Wahai, Indonesia (WBA)",

"Waingapo, Indonesia (WGP)",

"Wakkanai, Japan (WKJ)",

"Walaha, Vanuatu (WLH)",

"Walgett, NS, Australia (WGE)",

"Wallis Island, Wallis and Futuna Islands (WLS)",

"Walvis Bay, Namibia (WVB)",

"Wamena, Indonesia (WMX)",

"Wanaka, New Zealand (WKA)",

"Wanganui, New Zealand (WAG)",

"Wangerooge, Germany (AGE)",

"Wanigela, Papua New Guinea (AGL)",

"Wanxian, China (WXN)",

"Warsaw, Poland (WAW)",

"Wasior, Indonesia (WSR)",

"Wasu, Papua New Guinea (WSU)",

"Waterford, Ireland (WAT)",

"Wau, Papua New Guinea (WUG)",

"Wau, Sudan (WUU)",

"Wedau, Papua New Guinea (WED)",

"Wedjh, Saudi Arabia (EJH)",

"Weihai, China (WEH)",

"Weipa, QL, Australia (WEI)",

"Wellington, New Zealand (WLG)",

"Wenzhou, China (WNZ)",

"Westerland, Germany (GWT)",

"Westport, New Zealand (WSZ)",

"Westray, United Kingdom (WRY)",

"Wewak, Papua New Guinea (WWK)",

"Whakatane, New Zealand (WHK)",

"Whangarei, New Zealand (WRE)",

"Whyalla, SA, Australia (WYA)",

"Wick, United Kingdom (WIC)",

"Wilhelmshaven, Germany (WVN)",

"Wiluna, WA, Australia (WUN)",

"Windarra, QL, Australia (WNR)",

"Winton, QL, Australia (WIN)",

"Woja, Marshall Islands (WJA)",

"Wonan, Taiwan (WOT)",

"WonJu, South Korea (WJU)",

"Wotho Island, Marshall Islands (WTO)",

"Wotje Island, Marshall Islands (WTE)",

"Wroclaw, Poland (WRO)",

"Wudinna, SA, Australia (WUD)",

"Wuhan, China (WUH)",

"Wuyishan, China (WUS)",

"Wyndham, WA, Australia (WYN)",

"Xiamen, China (XMN)",

"Xi An, China - Xianyang (XIY)",

"Xiangfan, China (XFN)",

"Xichang, China (XIC)",

"Xieng Khouang, Laos (XKH)",

"Xilinhot, China (XIL)",

"Xining, China (XNN)",

"Xuzhou, China (XUZ)",

"Yakutsk, Russia (YKS)",

"Yalumet, Papua New Guinea (KYX)",

"Yam Island, QL, Australia (XMY)",

"Yamagata, Japan (GAJ)",

"Yan\'an, China (ENY)",

"Yanbu, Saudi Arabia (YNB)",

"Yancheng, China (YNZ)",

"Yandina, Solomon Islands (XYA)",

"Yangon, Myanmar (RGN)",

"Yanji, China (YNJ)",

"Yantai, China (YNT)",

"Yaounde, Cameroon (YAO)",

"Yap, Micronesia (YAP)",

"Yaroslavl, Russia (IAR)",

"Yazd, Iran (AZD)",

"Yelimane, Mali (EYL)",

"Yeosu, South Korea (RSU)",

"Yerevan, Armenia (EVN)",

"Yibin, China (YBP)",

"Yichang, China (YIH)",

"Yinchuan, China (INC)",

"Yining, China (YIN)",

"Yiwu, China (YIW)",

"Yogyakarta, Indonesia (JOG)",

"Yonago, Japan (YGJ)",

"Yonaguni Jima, Japan (OGN)",

"Yorke Island, QL, Australia (OKR)",

"Yoronjima, Japan (RNJ)",

"Yulin, China (UYN)",

"Yuzhno-Sakhalinsk, Russia (UUS)",

"Zadar, Croatia (ZAD)",

"Zagreb, Croatia (ZAG)",

"Zahedan, Iran (ZAH)",

"Zakinthos Island, Greece (ZTH)",

"Zamboanga, Philippines (ZAM)",

"Zanzibar, Tanzania - Kisauni (ZNZ)",

"Zaporozhye, Ukraine (OZH)",

"Zaragoza, Spain and Canary Islands (ZAZ)",

"Zhanjiang, China (ZHA)",

"Zhaotong, China (ZAT)",

"Zhengzha, China (CGO)",

"Zhob, Pakistan (PZH)",

"Zhoushan, China (HSN)",

"Zhuhai, China (ZUH)",

"Zielana, Poland (IEG)",

"Zihuatanejo/Ixtapa, Mexico (ZIH)",

"Zouerate, Mauritania (OUZ)",

"Zugapa, Indonesia (UGU)",

"Zurich, Switzerland (ZRH)"
		];
		$( "#from1" ).autocomplete({
			source: availableTags
		});
		$( "#to1" ).autocomplete({
			source: availableTags
		});
	});
	</script>