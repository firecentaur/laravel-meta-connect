/*********************************************
*  Copyright (c) 2022 Paul Preibisch
*
* register.lsl
*  Copyright:
*  Paul G. Preibisch (Fire Centaur in SL)
*  fire@b3dMultiTech.com  
* 
*/
string body="";
key httpRegister;
integer gListener;
string server ="";
string endpoint = "user/registerSlAvatar";
string myName;
string myKey;
integer MENU_CHANNEL;
integer YESNO_CHANNEL;
key     gSetupQueryId; //used for reading settings notecards
list    gInventoryList;//used for reading settings notecards
string     gSetupNotecardName="config";//used for reading settings notecards
integer gSetupNotecardLine;//used for reading settings notecards
// *************************************************** HOVER TEXT COLORS
vector     RED            = <0.77278, 0.04391, 0.00000>;//RED
vector     YELLOW         = <0.82192, 0.86066, 0.00000>;//YELLOW
vector     GREEN         = <0.12616, 0.77712, 0.00000>;//GREEN
vector     PINK         = <0.83635, 0.00000, 0.88019>;//INDIGO
vector     WHITE        = <1.000, 1.000, 1.000>;//WHITE

/***********************************************
*  getInventoryist()
*  used to read notecard settings
***********************************************/
list getInventoryList()
    {
    list       result = [];
    integer    n = llGetInventoryNumber(INVENTORY_ALL);
    integer    i = 0;

    while(i < n)
    {
        result += llGetInventoryName(INVENTORY_ALL, i);
        ++i;
    }
    return result;
 }
 /***********************************************************************************************
*  s()  k() i() and v() are used so that sending messages is more readable by humans.  
* Ie: instead of sending a linked message as
*  GETDATA|50091bcd-d86d-3749-c8a2-055842b33484 
*  Context is added with a tag: COMMAND:GETDATA|PLAYERUUID:50091bcd-d86d-3749-c8a2-055842b33484
*  All these functions do is strip off the text before the ":" char and return a string
***********************************************************************************************/
string s (string ss){
    return llList2String(llParseString2List(ss, [":"], []),1);
}//end function
key k (string kk){
    return llList2Key(llParseString2List(kk, [":"], []),1);
}//end function
integer i (string ii){
    return llList2Integer(llParseString2List(ii, [":"], []),1);
}//end function
/***********************************************
*  readSettingsNotecard()
*  |-->used to read notecard settings
***********************************************/
readSettingsNotecard()
{
   gSetupNotecardLine = 0;
   gSetupQueryId = llGetNotecardLine(gSetupNotecardName,gSetupNotecardLine); 
}
/*********************************************** 
*  readInv()  reads all the inv of type and returns list
*  Author: Paul Preibisch
*  fire@b3dmultitech.com, Fire Centaur in SL
***********************************************/
list readInv(integer type){
            integer    n = llGetInventoryNumber(INVENTORY_ALL);
              list       result = [];
            while(n){
                    if (llGetInventoryType(llGetInventoryName(INVENTORY_ALL, --n))==type){
                        result += llGetInventoryName(INVENTORY_ALL, --n) ;
                    }//endif                             
            }//end while
            return result;
}//end readInv

/***********************************************
*  random_integer()
*  |-->Produces a random integer
***********************************************/ 
integer random_integer( integer min, integer max )
{
  return min + (integer)( llFrand( max - min + 1 ) );
}
//change list into a string we can send via http
string keyValuesToString(list keyValues){
    integer index=0;
    list records = llList2ListStrided(keyValues,0,-1,2);
    integer length = llGetListLength(records);     
    integer stride=2;
    string returnStr="";
    while (index < length)
    {
        list item = llList2List(keyValues,index+index,index*stride+1);
        string param =  llList2String(item, 0);
        string value =  llList2String(item, 1);
        llSay(0,(string)index+": key:"+param+", value:"+value);
        returnStr+=param+"="+value;
          
        index++;
         if (index!=length){
        returnStr+="&";
        }     
    }  
    return returnStr;    
}
default {
    changed(integer change) { // something changed
        if (change ==CHANGED_INVENTORY){         
             llResetScript();
        }//endif
    }
     on_rez(integer start_param) {
        llResetScript();
    }
    
    state_entry() {
        llSay(0,"Initializing");
        myName = llGetObjectName();
        myKey = llGetKey();
        //make random menu channel to prevent interferance from other menus
        MENU_CHANNEL = random_integer(2000,3000);
        
        state readSettings;       
    }//end state_entry
}//end default

state readSettings{
    changed(integer change) { // something changed
        if (change ==CHANGED_INVENTORY){         
             llResetScript();
        }//endif
    }
      on_rez(integer start_param) {
          //ensure in default state
        llResetScript();
    }
    state_entry() {
        llSay(0,"Reading Config");
         readSettingsNotecard();    
    }//end state_entry
   dataserver(key queryId, string data)
    {
        if(queryId == gSetupQueryId) 
        {
            if(data != EOF){
                if (llGetSubString(data,0,1)=="//") {
                  gSetupQueryId = llGetNotecardLine(gSetupNotecardName,++gSetupNotecardLine); 
                }                
                list tmp= llParseString2List(data, ["|"], []);               
                string field= llList2String(tmp,0);                          
                if (field=="server") server=llToLower(llList2String(tmp, 1)); 
            
                 
                gSetupQueryId = llGetNotecardLine(gSetupNotecardName,++gSetupNotecardLine); 
            }
            else  state loaded;   
        }
    }      

}
state loaded{
    changed(integer change) { // something changed
        if (change ==CHANGED_INVENTORY){         
             llResetScript();
        }//endif
    }
    on_rez(integer start_param) {
        llResetScript();
    }
    state_entry() {
        llSay(0,"Ready - API is: "+server);
        state getinfo;
    }
}
state getinfo{
    changed(integer change) { // something changed
        if (change ==CHANGED_INVENTORY){         
             llResetScript();
        }//endif
    }
    on_rez(integer start_param) {
        llResetScript();
    }
    state_entry() {
        llSetText("Click to register with Laravel-Sl",RED,0);
     
    }
     touch_start(integer total_number)
    {
        // See 'discussion' page for more comments on choosing a channel and possible left-open listener
        
        // "" saves byte-code over NULL_KEY
        gListener = llListen( MENU_CHANNEL, "", "", "");     
        llTextBox(llDetectedKey(0), "Please enter your email address", MENU_CHANNEL);
    }
     listen(integer channel, string name, key id, string message)
    {
        string emailAddress="";
        llListenRemove(gListener);
        // get the UUID of the person touching this prim
       
        // Listen to any reply from that user only, and only on the same channel to be used by llDialog
        // It's best to set up the listener before issuing the dialog
        YESNO_CHANNEL=MENU_CHANNEL+1;
        if (channel == MENU_CHANNEL){
            
            emailAddress = message;
            llSay(0,"Email Address: "+message);
            gListener = llListen(YESNO_CHANNEL, "", id, "");
            // Send a dialog to that person. We'll use a fixed negative channel number for simplicity
            llDialog(id, "\nYou entered "+emailAddress+ " Is this correct?", ["Yes", "No" ] , YESNO_CHANNEL);
        }
        if (channel == YESNO_CHANNEL){
            llSay(0,"Email " + emailAddress+ " accepted ");
            state getPassword;
        }
        
    }
}
state getPassword{
        changed(integer change) { // something changed
            if (change ==CHANGED_INVENTORY){         
                 llResetScript();
            }//endif
        }
        on_rez(integer start_param) {
            llResetScript();
        }
        state_entry() {
           gListener = llListen( MENU_CHANNEL, "", "", "");     
           llTextBox(llDetectedKey(0), "Please enter a password", MENU_CHANNEL);
        }
        listen(integer channel, string name, key id, string password)
    	{
    		YESNO_CHANNEL = MENU_CHANNEL+1;
	        if (channel == MENU_CHANNEL){
	            
	        
	            llSay(0,"password: "+password);
	            gListener = llListen(YESNO_CHANNEL, "", id, "");
	            // Send a dialog to that person. We'll use a fixed negative channel number for simplicity
	            llDialog(id, "\nYou entered "+emailAddress+ " Is this correct?", ["Yes", "No" ] , YESNO_CHANNEL);
	        }
	        if (channel == YESNO_CHANNEL){
	            llSay(0,"Email " + emailAddress+ " accepted ");
	            state getPassword;
	        }
	        
	    }
}
state ready{
    changed(integer change) { // something changed
        if (change ==CHANGED_INVENTORY){         
             llResetScript();
        }//endif
    }
    on_rez(integer start_param) {
        llResetScript();
    }
    state_entry() {
        
        list paramList=["name","fire","email","fire@b3dmultitech.com"];
        string paramsToSend = keyValuesToString(paramList);
        string url = server+endpoint+paramsToSend;
        llSay(0,"Contacting server "+url);
        httpRegister = llHTTPRequest(url, [HTTP_METHOD, "GET", HTTP_MIMETYPE, "application/x-www-form-urlencoded"], body);  
         
    }
    http_response(key request_id, integer status, list metadata, string body) {
       llSay(0,body);
       

        
    }      
}