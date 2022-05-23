/*********************************************
*  Copyright (c) 2009 Paul Preibisch
*
* buzzer.lsl
*  Copyright:
*  Paul G. Preibisch (Fire Centaur in SL)
*  fire@b3dMultiTech.com  
* 
* This buzzer will start colored red. 
*  When teacher is ready, they click the ball, it turns green indicating it is ready to be clicked, count down timer displays
*  first three people to click get their name on the xy text 
* When clicked it makes clicking sound
* first click makes buzzer sound
*  teacher clicks on one of the names, and can assign points, or click (lose) to get a sound effect
*  Points go to the person instructure saved points for to the configured activity
* Play win sound
*
* Sound License
* Kodak Printer sound: http://www.freesound.org/samplesViewSingle.php?id=48667
* http://creativecommons.org/licenses/sampling+/1.0/
* nice.wav visit: http://www.freesound.org/samplesViewSingle.php?id=51488
* beepbeep.wav beep: http://www.freesound.org/samplesViewSingle.php?id=32683
*/
key     gSetupQueryId; //used for reading settings notecards
list    gInventoryList;//used for reading settings notecards
string     gSetupNotecardName="config";//used for reading settings notecards
integer gSetupNotecardLine;//used for reading settings notecards
integer SETTEXT_CHANNEL= -8882;
integer SET_COLOR_CHANNEL=-889;
integer SOUND_CHANNEL                                                     = -34000;//sound requests
integer TIME_S = 0;
integer TIME_M=1;
integer TIME_H=0;
integer keyPressCount;
integer MAX_TIME;
string editNum="";
integer SETTIMER=FALSE;
string SHOWARM="HIDE";
string editM;
string editS;
string editH;

list winners;
list winnerKeys;
list sitters;
list booths;
string myName;
integer buzzerButton;//to identify which link is the buzzerButton
key myKey;
list facilitators;//list of people who can control the buzzer
integer PLUGIN_RESPONSE_CHANNEL                                =998822; //sloodle_api.lsl responses
integer PLUGIN_CHANNEL                                                    =998821;//sloodle_api requests
integer UI_CHANNEL                                                            =89997;//UI Channel - main channel
integer ROW_CHANNEL;
// *************************************************** HOVER TEXT COLORS
vector     RED            = <0.77278, 0.04391, 0.00000>;//RED
vector     YELLOW         = <0.82192, 0.86066, 0.00000>;//YELLOW
vector     GREEN         = <0.12616, 0.77712, 0.00000>;//GREEN
vector     PINK         = <0.83635, 0.00000, 0.88019>;//INDIGO
vector     WHITE        = <1.000, 1.000, 1.000>;//WHITE
integer MENU_CHANNEL;
integer XY_1= -999821;
integer XY_2= -999822;
integer XY_3= -999823;
integer XY_TIMER= -999824;
integer XY_AWARD_NAME= -999825;
integer counter;
list modButs = ["+10","+30","-10","-30","+60","-60","+300","-300"];
list pointMods=["-5","-10","-100","-500","-1000","+5","+10","+100","+500","+1000","~~ SAVE ~~"]; //this is a list of values an owner can modify a users points to //["-5","-10","-100","-500","-1000","+5","+10","+100","+500","+1000",
list modifyPointList; //this is a temp list that is used to store point modifications in.  When Save is pressed on a menu, these points are applied to the users point bank
integer modPoints;
integer currentAwardId;
string currentAwardName;
list primNames;

//deletes an item from a list
list ListItemDelete(list mylist,string element_old) {
    integer placeinlist = llListFindList(mylist, [element_old]);
    if (placeinlist != -1){
        return llDeleteSubList(mylist, placeinlist, placeinlist);
    }
    return mylist;
}//listitemdelete
clear(){
        llMessageLinked(LINK_SET, XY_1,"                              ", NULL_KEY);
        llMessageLinked(LINK_SET, XY_2,"                              ", NULL_KEY);
        llMessageLinked(LINK_SET, XY_3,"                              ", NULL_KEY);
}
center(string s,integer len,integer channel){
            
            integer marginLen= (integer)(len-llStringLength((string)s))/2;
            integer j;
            string spaces="";
            for (j=0;j<len*10+1;++j){
                spaces+=" ";    
            }
            string margin = llGetSubString(spaces, 0, marginLen);
            string text = margin + (string)(s)+margin;
            llMessageLinked(LINK_SET, channel,text , NULL_KEY);
}

//returns the link number of the prim named pName
integer getLink(string pName){
    return (llListFindList(primNames,[pName]));
}
 //gets a vector from a string
vector getVector(string vStr){
        vStr=llGetSubString(vStr, 1, llStringLength(vStr)-2);
        list vStrList= llParseString2List(vStr, [","], ["<",">"]);
        vector output= <llList2Float(vStrList,0),llList2Float(vStrList,1),llList2Float(vStrList,2)>;
        return output;
}//end getVector
rotation getRot(string vStr){
        vStr=llGetSubString(vStr, 1, llStringLength(vStr)-2);
        list vStrList= llParseString2List(vStr, [","], ["<",">"]);
        rotation output= <llList2Float(vStrList,0),llList2Float(vStrList,1),llList2Float(vStrList,2),llList2Float(vStrList,3)>;
        return output;
}//end getRot

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
vector v (string vv){
    integer p = llSubStringIndex(vv, ":");
    string vString = llGetSubString(vv, p+1, llStringLength(vv));
    return getVector(vString);
}//end function
rotation r (string rr){
    integer p = llSubStringIndex(rr, ":");
    string rString = llGetSubString(rr, p+1, llStringLength(rr));
    return getRot(rString);
}//end function
preloadSounds(){
    key buzzer = "9412be1e-2e35-101d-fd69-5c3459b3432f";
    llPreloadSound(buzzer);    
    key tick = "23e88537-1817-df86-bb83-1e7d683ae493";
    llPreloadSound(tick);    
    key beepbeep = "fb9cab14-e8cd-04f2-e3fe-b776820ad2f1";
    llPreloadSound(beepbeep);    
    key onetype = "04d901bf-883d-e9f6-cb07-5c0f1b1f9d14";
    llPreloadSound(onetype );    
    key ipress = "c3b49393-6283-df99-c97b-f0b616fc6979";
    llPreloadSound(ipress );    
    key pd = "632d911f-10d1-2d30-c563-cdc29c3a7b56";
    llPreloadSound(pd );    
    key iopen = "cf218344-0251-6bfd-acba-fdd5534861b1";
    llPreloadSound(iopen );
}
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
*  isFacilitator()
*  |-->is this person's name in the access notecard
***********************************************/
integer isFacilitator(string avName){
    if (llListFindList(facilitators, [llToLower(avName)])==-1) return FALSE; else return TRUE;
}
/***********************************************
*  getMaxTime(integer seconds,integer minutes,integer hours)
*  |-->gets thenumber of seconds
***********************************************/
integer getSeconds(string seconds,string minutes,string hours){
    
    
    integer timeLeft = i(seconds)+60*i(minutes)+3600*i(hours);
    return timeLeft;
}
/***********************************************
*  getMaxTime(integer seconds,integer minutes,integer hours)
*  |-->gets thenumber of seconds and returns a formated list 00:00:00
***********************************************/
string  getTime(integer seconds){
    
    integer hours = (integer)(seconds/3600);
    
    integer minutes = (integer)((seconds/60)- (hours*60));
    
    integer s = (integer)(seconds%60);

    if (s ==60) { 
        minutes+=1;
        s = 0;
    }
    if (minutes==60){
        hours+=1;
        minutes=0;
    }
    string sString;
    string mString;
    string hString;
    if (llStringLength((string)s)==1) {
        sString= "0"+(string)s;
    }else sString = (string)s;
    if (llStringLength((string)minutes)==1) {
        mString= "0"+(string)minutes;
    }else mString = (string)minutes;
    if (llStringLength((string)hours)==1) {
        hString= "0"+(string)hours;
    }else hString = (string)hours;
    
    return hString+":"+mString+":"+sString;
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
string setTime;
 
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
        llTriggerSound("5992af3b-fde1-309f-4077-2c8d5cb7153c",1.0);//starting up
        MAX_TIME = TIME_S + TIME_M*60+TIME_H*3600;
        
        //get number of linked prims
        integer numPrims = llGetNumberOfPrims();
        //find out which one is buzzer prim
        integer j;
        for (j=0;j<=numPrims;j++){
            primNames +=llGetLinkName(j);          
        }//endfor
       
        
         llMessageLinked(LINK_SET, 1, "p0",NULL_KEY);
        myName = llGetObjectName();
        myKey = llGetKey();
        MENU_CHANNEL = random_integer(2000,3000);
        ROW_CHANNEL=random_integer(2483000,3483000);
       
        state readAccessList;       
    }//end state_entry
}//end default
//read from notecard who can control
state readAccessList{
      on_rez(integer start_param) {
        llResetScript();
    }
    state_entry() {
        facilitators+=llToLower(llKey2Name(llGetOwner()));
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
                if (field=="facilitator") facilitators+=llToLower(llList2String(tmp, 1)); 

                 
                gSetupQueryId = llGetNotecardLine(gSetupNotecardName,++gSetupNotecardLine); 
            }
            else  state ready;   
        }
    }      

}
         
state makeReady{
      on_rez(integer start_param) {
        llResetScript();
    }
    state_entry() {
        llOwnerSay("Preloading Sounds... please wait");
        preloadSounds();
        SHOWARM="HIDE";
         state ready;
    }
}
//waiting for teacher to touch it
state ready{
    on_rez(integer start_param) {
        llResetScript();
    }
    state_entry() {
        llTriggerSound("ea0fb023-c741-916b-e5aa-d02ef9995aba", 1.0);//loading complete
        
        llOwnerSay("Ready! Click the green cylindar to engage the buzzer!\nPress the red cylindar to disengage the buzzer, and the yellow cylindar to hide it!");
        integer j=0;
        integer len = llGetListLength(booths);
        sitters=[];
       
        /****************************************
        *  INITIALIZE
        *****************************************/
            
            
           
          
            llSetTimerEvent(0);
            //move arm to waiting position
            llMessageLinked(LINK_SET, 1, "p1",NULL_KEY);
            winners=[];
            winnerKeys=[];
            modifyPointList=[0,0,0];            
        /****************************************
        *  PLAY SOUNDS
        *****************************************/
           llTriggerSound("cf218344-0251-6bfd-acba-fdd5534861b1", 1.0);//fastkodak

        /****************************************
        *  INIT DISPLAY
        *****************************************/
            //center text
           center("00:00:00",10,XY_TIMER);
            //set hover text
            llMessageLinked(LINK_SET,SETTEXT_CHANNEL,"DISPLAY::top display|STRING::Ready:|COLOR::"+(string)RED+"|ALPHA::1.0",NULL_KEY);
            //clear text
            clear();
            //set red
            llMessageLinked(LINK_SET,SET_COLOR_CHANNEL,"COMMAND:SET COLOR|PRIM:buzzer_button|COLOR:RED",NULL_KEY);
    }//end state_entry


    
    
    touch_start(integer num_detected) {
        string butName = llGetLinkName(llDetectedLinkNumber(0));
        //each prim that has a blink.lsl script in it, will set its glow to .90 for 1 second when this message is received
            
        
        if (isFacilitator(llDetectedName(0))){
            
                llMessageLinked(LINK_SET, UI_CHANNEL, "COMMAND:BLINK|PRIM:"+butName, NULL_KEY);
                if (butName=="hide_arm_button"){
                    llMessageLinked(LINK_SET, 1, "p0",NULL_KEY);
                   llTriggerSound("cf218344-0251-6bfd-acba-fdd5534861b1", 1.0);//fastkodak
                    return;
                    
                }//endif
                else
               if (butName=="dock_arm"){    
              //     if (SHOWARM=="SHOW"){
                    llSetLinkPrimitiveParams(getLink("buzzer_button"), [PRIM_COLOR, ALL_SIDES, RED, 1.0,
                    PRIM_TEXTURE, 0, "blank",<1.0, 1.0, 0.0>, <0.0, 0.0, 0.0>, 0.0 ]);
                    llTriggerSound("632d911f-10d1-2d30-c563-cdc29c3a7b56", 1.0);//power down
                     llMessageLinked(LINK_SET, 1, "p1",NULL_KEY);
                     SHOWARM="HIDE";
                     return;
              //     }//SHOWARM
                  
              }//endifndif
              else 
              if (butName=="show_arm"){
                    SHOWARM="SHOW";
                    llMessageLinked(LINK_SET, UI_CHANNEL, "COMMAND:BLINK|PRIM:timer", NULL_KEY);
                    llTriggerSound("29cc964b-69ea-cdb2-e73a-3744d7aa83fb", 1.0);
                    llSetLinkPrimitiveParams(getLink("buzzer_button"), [PRIM_COLOR, ALL_SIDES, GREEN, 1.0,
                    PRIM_TEXTURE, 0, "click",<1.0, 1.0, 0.0>, <0.0, 0.0, 0.0>, 0.0 ]);
                    llMessageLinked(LINK_SET, 1, "p2",NULL_KEY); 
                    llTriggerSound("cf218344-0251-6bfd-acba-fdd5534861b1", 1.0);//fastkodak


                    winners=[];
                    return;
             }//endif
            else 
            if (butName=="hide_arm_button"){    
                SHOWARM="HIDE";
                 state makeReady;                    
            }//endif
            else         
            if (butName=="stopwatch_button"){        
                 llTriggerSound("14657220-fdd8-8d45-292d-a21950c05e23", 1.0);//SPACCODE buzzer button press    
                  llSetTimerEvent(0);
                  
                  SETTIMER=FALSE;
                  return;
            }//endif
            else
            if (butName=="resetwatch_button"){        
                 llTriggerSound("14657220-fdd8-8d45-292d-a21950c05e23", 1.0);//SPACCODE buzzer button press    
                  llSetTimerEvent(0);
                  counter=0;
                      MAX_TIME= TIME_S + TIME_M*60+TIME_H*3600;  
                      SETTIMER=FALSE;
                      integer timeLeft = MAX_TIME-counter;
                    string printTime = getTime(timeLeft);
                    center(printTime,10,XY_TIMER);
                    return;
            }//endif
            else 
            if (butName=="startwatch_button"){
             if (SETTIMER==TRUE){                       
                  TIME_S = (integer)llGetSubString(editNum, 6,7);
                  TIME_M =(integer)llGetSubString(editNum, 3,4);
                  TIME_H = (integer)llGetSubString(editNum, 0,1);                
                  SETTIMER==FALSE;
                  
              }
              MAX_TIME= TIME_S + TIME_M*60+TIME_H*3600;  
               llTriggerSound("14657220-fdd8-8d45-292d-a21950c05e23", 1.0);//SPACCODE buzzer button press
               
                
                llSetTimerEvent(1); 
                return;                   
            }//endif
           else
           if (butName=="set_timer"){
                llTriggerSound("c3b49393-6283-df99-c97b-f0b616fc6979", 1.0);//interface press        
                llSetTimerEvent(0);
                keyPressCount=0;
                
                if (SETTIMER==TRUE){
                    //Sound source: http://www.freesound.org/samplesViewSingle.php?id=2329
//license: http://creativecommons.org/licenses/sampling+/1.0/

                llTriggerSound("dcebaa0e-d4d1-4e66-dc94-d453b7c78eb6", 1.0);//confirmed


                    TIME_S = (integer)llGetSubString(editNum, 6,7);
                      TIME_M =(integer)llGetSubString(editNum, 3,4);
                      TIME_H = (integer)llGetSubString(editNum, 0,1);                
                    MAX_TIME= TIME_S + TIME_M*60+TIME_H*3600;  
                   
                    SETTIMER=FALSE; 
                    integer timeLeft = MAX_TIME-counter;
                    string printTime = getTime(timeLeft);
                    center(printTime,10,XY_TIMER);
                }else {
                    editNum="00:00:00";
                    SETTIMER=TRUE;
                }
                return;
            }//endif          
         else
         if (butName=="backspace"){
               if (SETTIMER==TRUE){
                      if (llStringLength(editNum)==1) editNum="";
                    else editNum= llGetSubString(editNum,0,llStringLength(editNum)-2);
                   llTriggerSound("04d901bf-883d-e9f6-cb07-5c0f1b1f9d14", 1.0);//one type
                    center(editNum,10,XY_TIMER);
              }//SETTIMER
              return;
        }//backspace
        else 
        if (llListFindList(["b1","b2","b3","b4","b5","b6","b7","b8","b9","b0"],[butName])!=-1){
            if (SETTIMER==TRUE){
                    counter=0;
                    keyPressCount++;
                    string printTime ="";
                    string num = llGetSubString(butName,1,1);
                    if (keyPressCount==1) editNum =llGetSubString(editNum, 0, 6)+num; else
                    if (keyPressCount==2) editNum =llGetSubString(editNum, 0, 5) +llGetSubString(editNum, 7, 7) + num; else
                    if (keyPressCount==3) editNum =llGetSubString(editNum, 0, 3) +llGetSubString(editNum, 6, 6) +":" +llGetSubString(editNum, 7, 7) + num; else
                    if (keyPressCount==4) editNum =llGetSubString(editNum, 0, 2) +llGetSubString(editNum, 4, 4) +llGetSubString(editNum, 6, 6) + ":" +llGetSubString(editNum, 7, 7) + num; else
                    if (keyPressCount==5) editNum ="0"+llGetSubString(editNum, 3, 3) +":"+llGetSubString(editNum, 4, 4) +llGetSubString(editNum, 6, 6) + ":" +llGetSubString(editNum, 7, 7) + num; else
                    if (keyPressCount==6) editNum =llGetSubString(editNum, 1, 1) +llGetSubString(editNum, 3, 3)+":" +llGetSubString(editNum, 4, 4)  +llGetSubString(editNum, 6, 6) + ":" +llGetSubString(editNum, 7, 7) + num;
                    setTime = editNum;
                    center(editNum,10,XY_TIMER);
                    llTriggerSound("04d901bf-883d-e9f6-cb07-5c0f1b1f9d14", 1.0);//one type
            }//SETTIMER==TRUE
            return;
        }//end if llListFind
               
        }//end if facilitator
         else 
         if  (butName!="buzzer_button") llSay(0,"Sorry, you need to be a facilitator to use this function.  Facilitators are: "+(string)llList2CSV(facilitators));
       
        
        /********************************************************
        *  Player clicks
        *********************************************************/
        if (butName=="buzzer_button"){
   //         llSay(0,(string)llList2CSV(sitters)+"**********"+(string)llDetectedKey(0));
          //  if (llListFindList(sitters, [llDetectedKey(0)])!=-1){
                    //llMessageLinked(LINK_SET,SOUND_CHANNEL, "COMMAND:PLAYSOUND|SOUND:beep|SCRIPT_NAME:soundPlayer 1|VOLUME:1.0",NULL_KEY);                          
                    integer printChannel;
                    string userName=llDetectedName(0);
                    key userKey = llDetectedKey(0);                
                       if (SHOWARM=="SHOW"){
                   //       if (llListFindList(sitters, [llDetectedKey(0)])!=-1){
                                  llMessageLinked(LINK_SET, UI_CHANNEL, "COMMAND:BLINK|PRIM:"+butName, NULL_KEY);
                              //only 3 people are allowed to click
                             if (llListFindList(winners, [userName])==-1){
                                 //if hasnt been added, add to winners
                                 winners+=userName;
                                 winnerKeys+=userKey;
                                 //get number of winners
                                 integer numWinners = llGetListLength(winners);
                                 string anim="p3";
                                 if (numWinners<4){
                                     //play buzzer sound if one of the first 3 to click
                                     llTriggerSound("3664dabd-5d57-d124-8929-e1fafdbdc55c", 1.0);//game_show_buzzer_hit
                                     if (numWinners ==1){
                                         printChannel=XY_1;
                                         anim = "p3";
                                     }else
                                     if (numWinners ==2){
                                         printChannel=XY_2;
                                         anim ="p4";
                                     }else
                                     if (numWinners ==3){
                                         printChannel=XY_3;
                                         anim ="p5";
                                     }
                             //only print username on scoreboard if one of the first 3 to click    
                             llMessageLinked(LINK_SET, printChannel,userName, NULL_KEY);
                             //play animation
                             llMessageLinked(LINK_SET, 1, anim,NULL_KEY);
                             return;
                          }//endif numWinners < 4
                         }//findlist winners             
                  //   }//findlist sitters
                   } //showarm           
             //  }//findlist sitters 
        }//end if buttname
    }//end touch
    timer() {
        //gets thenumber of seconds and returns a formated list 00:00:00
        
        integer timeLeft = MAX_TIME-counter;
        string printTime = getTime(timeLeft);
        center(printTime,10,XY_TIMER);
        ++counter;
          if (timeLeft<5){
          llTriggerSound("fb9cab14-e8cd-04f2-e3fe-b776820ad2f1", 1.0);//beep beepbeep beep
        }else
        llTriggerSound("23e88537-1817-df86-bb83-1e7d683ae493", 1.0);//tick
        if (counter>MAX_TIME){                
            llSetTimerEvent(0.0);
            llMessageLinked(LINK_SET, 1, "bp0",NULL_KEY);         
            counter=0;
            center("00:00:00",10,XY_TIMER);
           llTriggerSound("9412be1e-2e35-101d-fd69-5c3459b3432f", 1.0);//buzzer
}        
        }//end timer    
          changed(integer change) { // something changed
        if (change ==CHANGED_INVENTORY){         
             llResetScript();
        }//endif
    }
}//end state


