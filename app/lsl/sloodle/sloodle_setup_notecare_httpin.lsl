// sloodle.sloodle_setup_notecare_httpin.lslp 
// 2022-05-23 14:10:10 - LSLForge (0.1.9.6) generated
// Sloodle configuration notecard reader
// Reads a configuration notecard and transmits the data via link messages to other scripts
// If the notecard changes, then it automatically resets.
//
// Part of the Sloodle project (www.sloodle.org)
// Copyright (c) 2007-8 Sloodle
// Released under the GNU GPL v3
//
// Contributors:
//  Edmund Edgar
//  Peter R. Bloomfield



string SLOODLE_CONFIG_NOTECARD = "sloodle_config";

key sloodle_notecard_key = NULL_KEY;
integer sloodle_notecard_line = 0;

string COMMENT_PREFIX = "//";

key latestnotecard = NULL_KEY;
string notecarddata = "";
string httpinurl = "";
integer isnotecarddone = 0;

string sloodlepwd = "";
string sloodleserverroot = "";
string sloodlecontrollerid = "";
    

string SLOODLE_HTTP_IN_REQUEST_LINKER = "/mod/sloodle/classroom/httpin_config_linker.php";
integer SLOODLE_CHANNEL_OBJECT_CREATOR_REQUEST_CONFIGURATION_VIA_HTTP_IN_URL = -1639270089;

sloodle_start_reading_notecard(){
  if ((llGetInventoryType(SLOODLE_CONFIG_NOTECARD) == INVENTORY_NOTECARD)) {
    (sloodle_notecard_line = 0);
    (sloodle_notecard_key = llGetNotecardLine("sloodle_config",0));
    (latestnotecard = llGetInventoryKey(SLOODLE_CONFIG_NOTECARD));
  }
  else  {
    (latestnotecard = NULL_KEY);
  }
}

register_config_if_ready(){
  if (((httpinurl == "") || (isnotecarddone == 0))) {
    return;
  }
  if (((sloodleserverroot == "") || (sloodlepwd == ""))) {
    return;
  }
  string body = ("sloodlecontrollerid=" + ((string)sloodlecontrollerid));
  (body += ("&sloodlepwd=" + sloodlepwd));
  (body += ("&sloodleobjuuid=" + ((string)llGetKey())));
  (body += ("&childobjectuuid=" + ((string)llGetKey())));
  (body += ("&httpinurl=" + httpinurl));
  (body += ("&sloodleobjname=" + llGetObjectName()));
  (body += notecarddata);
  llHTTPRequest((sloodleserverroot + SLOODLE_HTTP_IN_REQUEST_LINKER),[HTTP_METHOD,"POST",HTTP_MIMETYPE,"application/x-www-form-urlencoded"],body);
}

default {

    on_rez(integer start_param) {
    llResetScript();
  }

    
    state_entry() {
    llSleep(0.2);
    sloodle_start_reading_notecard();
  }

    
    dataserver(key requested,string data) {
    if ((requested == sloodle_notecard_key)) {
      (sloodle_notecard_key = NULL_KEY);
      if ((data != EOF)) {
        string trimmeddata = llStringTrim(data,STRING_TRIM_HEAD);
        if ((llSubStringIndex(trimmeddata,COMMENT_PREFIX) != 0)) {
          list bits = llParseString2List(data,["|"],[]);
          integer numbits = llGetListLength(bits);
          string name = llList2String(bits,0);
          string value1 = "";
          if ((numbits > 1)) (value1 = llList2String(bits,1));
          if ((name == "set:sloodleserverroot")) (sloodleserverroot = value1);
          else  if ((name == "set:sloodlepwd")) (sloodlepwd = value1);
          else  if ((name == "set:sloodlecontrollerid")) (sloodlecontrollerid = value1);
          else  (notecarddata = ((((notecarddata + "&") + name) + "=") + value1));
        }
        (sloodle_notecard_line++);
        (sloodle_notecard_key = llGetNotecardLine("sloodle_config",sloodle_notecard_line));
      }
      else  {
        (isnotecarddone = 1);
        register_config_if_ready();
      }
    }
  }

    
    link_message(integer sender_num,integer num,string str,key id) {
    if ((num == SLOODLE_CHANNEL_OBJECT_CREATOR_REQUEST_CONFIGURATION_VIA_HTTP_IN_URL)) {
      (httpinurl = str);
      register_config_if_ready();
    }
  }

    
    changed(integer change) {
    if (((change & CHANGED_INVENTORY) && (llGetInventoryType(SLOODLE_CONFIG_NOTECARD) == INVENTORY_NOTECARD))) {
      if ((llGetInventoryKey(SLOODLE_CONFIG_NOTECARD) != latestnotecard)) llResetScript();
    }
  }
}
// sloodle.sloodle_setup_notecare_httpin.lslp 
// 2022-05-23 14:10:10 - LSLForge (0.1.9.6) generated
