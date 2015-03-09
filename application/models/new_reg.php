<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN Registration DB functions
*/

class New_reg extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function newSchool($schoolName, $schoolAddress, $schoolCity, $schoolState, $schoolZIP, $delSlots, $delType, $crisis, $press, $country1, $country2, $country3, $otherPrefs){
	//Use CI's active record. It's clearer than SQL statements and auto escapes data.
	$school = array(
	   'name' => $schoolName ,
	   'address' => $schoolAddress ,
	   'city' => $schoolCity,
	   'state' => $schoolState,
	   'zipcode' => $schoolZIP,
	   'req_del_slots' => $delSlots ,
	   'del_type' => $delType,
	   'crisis' => $crisis, 
	   'press' => $press, 
	   'country1' => $country1, 
	   'country2' => $country2, 
	   'country3' => $country3,
	   'other_prefs' => $otherPrefs,
	   'waitlist' => "yes"
	);
	
	$this->db->insert('schools', $school); 

	$idQuery = $this->db->query('SELECT * FROM schools WHERE name=\''.$schoolName.'\' AND zipcode=\''.$schoolZIP.'\'');
	if ($idQuery->num_rows() > 0){
		if ($idQuery->num_rows() > 1){
			//multiple schools, throw error
			return false;
		}elseif($idQuery->num_rows() == 1){
		$row = $idQuery->row(); 

		$schoolID = $row->id;
		return $schoolID;
		}
	}else{
		//0 rows returned
		return false;
	}
	}
	public function newPrimaryAdviser($userid, $schoolid, $fullName, $phone){
	//Use CI's active record. It's clearer than SQL statements and auto escapes data.
	$type = 'primary';
	$adviser = array(
	   'userid' => $userid ,
	   'schoolid' => $schoolid ,
	   'name' => $fullName,
	   'phone' => $phone,
	   'type' => $type
	);
	
	$this->db->insert('advisers', $adviser); 
	//
	$adviserQuery = $this->db->query('SELECT * FROM advisers WHERE userid=\''.$userid.'\' AND schoolid=\''.$schoolid.'\'');
	if ($adviserQuery->num_rows() > 0){
		if ($adviserQuery->num_rows() > 1){
			//multiple advisers, throw error
			return false;
		}elseif($adviserQuery->num_rows() == 1){
		$row = $adviserQuery->row(); 
		$adviserName = $row->name;
		return $adviserName;
		}
	}else{
		//0 rows returned
		return false;
	}

		
	}
	public function newSecondaryAdviser($schoolid, $fullName, $phone){
	//Use CI's active record. It's clearer than SQL statements and auto escapes data.
	$type = 'secondary';
	$adviser = array(
	   'schoolid' => $schoolid ,
	   'name' => $fullName,
	   'phone' => $phone,
	   'type' => $type
	);
	
	$this->db->insert('add_advisers', $adviser); 
			
	}
	
	public function confirmationMessage(){
	$query = $this->db->query('SELECT * FROM conference WHERE current=1');
	if ($query->num_rows() > 0){
		if ($query->num_rows() > 1){
			//multiple conferences, throw error
			return false;
		}elseif($query->num_rows() == 1){
		$row = $query->row(); 
		$thankYou = $row->reg_thank_you;
		$secGen = $row->sec_gen;
		$numerals = $row->numerals;
		$confPage = array(
			'thankYou' => $thankYou,
			'secGen' => $secGen,
			'numerals' => $numerals,
		);
		return $confPage;
		}
	}else{
		//0 rows returned
		return false;
	}
		
	}
	
	public function setCustomerNumber($id, $customer){
		$customerNumber = array('customer' => $customer);
		$this->db->where('id', $id);
		$this->db->update('schools', $customerNumber);
	}
	
	public function confirmEmailBody($name, $school){
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <!-- NAME: 1 COLUMN - BANDED -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width initial-scale=1.0">
        <title>Activate Your Account</title>

    <style type="text/css">
body, #bodyTable, #bodyCell{
  height:100% !important;
  margin:0;
  padding:0;
  width:100% !important;
}
table{
  border-collapse:collapse;
}
img, a img{
  border:0;
  outline:none;
  text-decoration:none;
}
h1, h2, h3, h4, h5, h6{
  margin:0;
  padding:0;
}
p{
  margin:1em 0;
  padding:0;
}
a{
  word-wrap:break-word;
}
.ReadMsgBody{
  width:100%;
}
.ExternalClass{
  width:100%;
}
.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalC=
lass font, .ExternalClass td, .ExternalClass div{
  line-height:100%;
}
table, td{
  mso-table-lspace:0pt;
  mso-table-rspace:0pt;
}
#outlook a{
  padding:0;
}
img{
  -ms-interpolation-mode:bicubic;
}
body, table, td, p, a, li, blockquote{
  -ms-text-size-adjust:100%;
  -webkit-text-size-adjust:100%;
}
#bodyCell{
  padding:0;
}
.mcnImage{
  vertical-align:bottom;
}
.mcnTextContent img{
  height:auto !important;
}
body, #bodyTable{
  background-color:#F2F2F2;
}
#bodyCell{
  border-top:0;
}
h1{
  color:#606060 !important;
  display:block;
  font-family:Helvetica;
  font-size:40px;
  font-style:normal;
  font-weight:bold;
  line-height:125%;
  letter-spacing:-1px;
  margin:0;
  text-align:left;
}
h2{
  color:#404040 !important;
  display:block;
  font-family:Helvetica;
  font-size:26px;
  font-style:normal;
  font-weight:bold;
  line-height:125%;
  letter-spacing:-.75px;
  margin:0;
  text-align:left;
}
h3{
  color:#606060 !important;
  display:block;
  font-family:Helvetica;
  font-size:18px;
  font-style:normal;
  font-weight:bold;
  line-height:125%;
  letter-spacing:-.5px;
  margin:0;
  text-align:left;
}
h4{
  color:#808080 !important;
  display:block;
  font-family:Helvetica;
  font-size:16px;
  font-style:normal;
  font-weight:bold;
  line-height:125%;
  letter-spacing:normal;
  margin:0;
  text-align:left;
}
#templatePreheader{
  background-color:#FFFFFF;
  border-top:0;
  border-bottom:0;
}
.preheaderContainer .mcnTextContent, .preheaderContainer .mcnTextContent p{
  color:#606060;
  font-family:Helvetica;
  font-size:11px;
  line-height:125%;
      text-align:left;
    }
    .preheaderContainer .mcnTextContent a{
      color:#606060;
      font-weight:normal;
      text-decoration:underline;
    }
    #templateHeader{
      background-color:#FFFFFF;
      border-top:0;
      border-bottom:0;
    }
    .headerContainer .mcnTextContent, .headerContainer .mcnTextContent p{
      color:#606060;
      font-family:Helvetica;
      font-size:15px;
      line-height:150%;
      text-align:left;
    }
    .headerContainer .mcnTextContent a{
      color:#6DC6DD;
      font-weight:normal;
      text-decoration:underline;
    }
    #templateBody{
      background-color:#FFFFFF;
      border-top:0;
      border-bottom:0;
    }
    .bodyContainer .mcnTextContent, .bodyContainer .mcnTextContent p{
      color:#606060;
      font-family:Helvetica;
      font-size:15px;
      line-height:150%;
      text-align:left;
    }
    .bodyContainer .mcnTextContent a{
      color:#6DC6DD;
      font-weight:normal;
      text-decoration:underline;
    }
    #templateFooter{
      background-color:#F2F2F2;
      border-top:0;
      border-bottom:0;
    }
    .footerContainer .mcnTextContent, .footerContainer .mcnTextContent=
 p{
      color:#606060;
      font-family:Helvetica;
      font-size:11px;
      line-height:125%;
      text-align:left;
    }
    .footerContainer .mcnTextContent a{
      color:#606060;
      font-weight:normal;
      text-decoration:underline;
    }
  @media only screen and (max-width: 480px){
    body, table, td, p, a, li, blockquote{
      -webkit-text-size-adjust:none !important;
    }

}  @media only screen and (max-width: 480px){
    body{
      width:100% !important;
      min-width:100% !important;
    }

}  @media only screen and (max-width: 480px){
    table[class=mcnTextContentContainer]{
      width:100% !important;
    }

}  @media only screen and (max-width: 480px){
    table[class=mcnBoxedTextContentContainer]{
      width:100% !important;
    }

}  @media only screen and (max-width: 480px){
    table[class=mcpreview-image-uploader]{
      width:100% !important;
      display:none !important;
    }

}  @media only screen and (max-width: 480px){
    img[class=mcnImage]{
      width:100% !important;
    }

}  @media only screen and (max-width: 480px){
    table[class=mcnImageGroupContentContainer]{
      width:100% !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=mcnImageGroupContent]{
      padding:9px !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=mcnImageGroupBlockInner]{
      padding-bottom:0 !important;
      padding-top:0 !important;
    }

}  @media only screen and (max-width: 480px){
    tbody[class=mcnImageGroupBlockOuter]{
      padding-bottom:9px !important;
      padding-top:9px !important;
    }

}  @media only screen and (max-width: 480px){
    table[class: mcnCaptionTopContent], table[class=mcnCaptionBott=
omContent]{
      width:100% !important;
    }

}  @media only screen and (max-width: 480px){
    table[class=mcnCaptionLeftTextContentContainer], table[class=mcnCaptionRightTextContentContainer], table[class=mcnCaptionLeftImageContentContainer], table[class=mcnCaptionRightImageContentContainer], table[class=mcnImageCardLeftTextContentContainer], table[class=mcnImageCardRightTextContentContainer]{
      width:100% !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=mcnImageCardLeftImageContent], td[class=mcnImageCardRightImageContent]{
      padding-right:18px !important;
      padding-left:18px !important;
      padding-bottom:0 !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=mcnImageCardBottomImageContent]{
      padding-bottom:9px !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=mcnImageCardTopImageContent]{
      padding-top:18px !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=mcnImageCardLeftImageContent], td[class=mcnImageCardRightImageContent]{
      padding-right:18px !important;
      padding-left:18px !important;
      padding-bottom:0 !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=mcnImageCardBottomImageContent]{
      padding-bottom:9px !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=mcnImageCardTopImageContent]{
      padding-top:18px !important;
    }

}  @media only screen and (max-width: 480px){
    table[class=mcnCaptionLeftContentOuter] td[class=mcnTextContent], table[class=mcnCaptionRightContentOuter] td[class=mcnTextContent]{
      padding-top:9px !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=mcnCaptionBlockInner] table[class=mcnCaptionTopContent]:last-child td[class=mcnTextContent]{
      padding-top:18px !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=mcnBoxedTextContentColumn]{
      padding-left:18px !important;
      padding-right:18px !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=mcnTextContent]{
      padding-right:18px !important;
      padding-left:18px !important;
    }

}  @media only screen and (max-width: 480px){
    table[class=templateContainer]{
      max-width:600px !important;
      width:100% !important;
    }

}  @media only screen and (max-width: 480px){
    h1{
      font-size:24px !important;
      line-height:125% !important;
    }

}  @media only screen and (max-width: 480px){
    h2{
      font-size:20px !important;
      line-height:125% !important;
    }

}  @media only screen and (max-width: 480px){
    h3{
      font-size:18px !important;
      line-height:125% !important;
    }

}  @media only screen and (max-width: 480px){
    h4{
      font-size:16px !important;
      line-height:125% !important;
    }

}  @media only screen and (max-width: 480px){
    table[class=mcnBoxedTextContentContainer] td[class=mcnTextContent], td[class=mcnBoxedTextContentContainer] td[class=mcnTextContent] p{
      font-size:18px !important;
      line-height:125% !important;
    }

}  @media only screen and (max-width: 480px){
    table[id=templatePreheader]{
      display:block !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=preheaderContainer] td[class=mcnTextContent], td[class=preheaderContainer] td[class=mcnTextContent] p{
      font-size:14px !important;
      line-height:115% !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=headerContainer] td[class=mcnTextContent], td[class=headerContainer] td[class=mcnTextContent] p{
      font-size:18px !important;
      line-height:125% !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=bodyContainer] td[class=mcnTextContent], td[class=bodyContainer] td[class=mcnTextContent] p{
      font-size:18px !important;
      line-height:125% !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=footerContainer] td[class=mcnTextContent],td[class=footerContainer] td[class=mcnTextContent] p{
      font-size:14px !important;
      line-height:115% !important;
    }

}  @media only screen and (max-width: 480px){
    td[class=footerContainer] a[class=utilityLink]{
      display:block !important;
    }

}
</style>
</head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight=
="0" offset="0" style="margin: 0;padding: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #F2F2F2;height: 100% !important; width: 100% !important;">
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="border=
-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;background-color: #F2F2F2;height: 100% !important;width: 100% !important;">
                <tr>
                    <td align="center" valign="top" id="bodyCell" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;border-top: 0;height: 100% !important;width: 100% !important;">
                        <!-- BEGIN TEMPLATE // -->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace:0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                            <tr>
                                <td align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                    <!-- BEGIN PREHEADER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templatePreheader" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;">
                                        <tr>
                                          <td align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                    <tr>
                                                        <td valign="top" class="preheaderContainer" style="padding-top: 9px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="366" class="mcnTextContentContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                    <tbody><tr>

                        <td valign="top" class="mcnTextContent" style="padding-top: 9px;padding-left: 18px;padding-bottom: 9px;padding-right:0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #606060;font-family: Helvetica;font-size: 11px;line-height: 125%;text-align: left;">

                           Your NUMUN account is ready.
                        </td>
                    </tr>
                </tbody></table>

                <table align="right" border="0" cellpadding="0" cellspacing="0" width="197" class="mcnTextContentContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                    <tbody><tr>

                        <td valign="top" class="mcnTextContent" style="padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #606060;font-family: Helvetica;font-size: 11px;line-height: 125%;text-align: left;">

                            
                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END PREHEADER -->
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                    <!-- BEGIN HEADER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;">
                                        <tr>
                                            <td align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                    <tr>
                                                        <td valign="top" class="headerContainer" style="padding-top: 10px;padding-bottom: 10px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace:0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding: 9px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">


                                        <img align="left" alt="Northwestern University Model United Nations" src="https://gallery.mailchimp.com/730fd923a1c77757474ab8fd3/images/1b9bfccb-2eb6-4968-83e7-562a902e946a.png" width="240" style="max-width: 240px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" class="mcnImage">


                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END HEADER -->
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                    <!-- BEGIN BODY // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #FFFFFF;border-top: 0;border-bottom: 0;">
                                        <tr>
                                            <td align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                    <tr>
                                                        <td valign="top" class="bodyContainer" style="padding-top: 10px;padding-bottom: 10px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="mcnTextContentContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                    <tbody><tr>

                        <td valign="top" class="mcnTextContent" style="padding: 9px 18px;font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;font-size: 14px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #606060;line-height: 150%;text-align: left;">

                            <h1 style="margin: 0;padding: 0;display: block;font-family: Helvetica;font-size: 40px;font-style: normal;font-weight: bold;line-height: 125%;letter-spacing: -1px;text-align: left;color: #606060 !important;">NUMUN XII Registration<span style="font-size:13px; line-height:1.6em">&nbsp;</span></h1>
<br>
<span>'.$name.',</span><br>
Thank you for registering for NUMUN XII. Your account at numun.org is now ready to use. This email also serves as a notice that your school, '.$school.', is on the waitlist for NUMUN.<br>
We will send you an email if we have enough capacity to accommodate your school.<br>
Thank you again for choosing NUMUN.

                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnButtonBlockOuter">
        <tr>
            <td style="padding-top: 0;padding-right: 18px;padding-bottom: 18px;padding-left: 18px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="left" class="mcnButtonBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" class="mcnButtonContentContainer" style="border-collapse: separate !important;border: 2px none #707070;border-top-left-radius: 5px;border-top-right-radius: 5px;border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;background-color: #16AE6F;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                    <tbody>
                        <tr>
                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Arial;font-size: 16px;padding: 20px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                <a class="mcnButton " title="Activate Account" href="https://secure.numun.org" target="_blank" style="font-weight: normal;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;word-wrap: break-word;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Log in to your Account</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="padding: 18px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top-width: 1px;border-top-style: solid;border-top-color: #999999;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                    <tbody><tr>
                        <td style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="mcnTextContentContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                    <tbody><tr>

                        <td valign="top" class="mcnTextContent" style="padding: 9px 18px;font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;font-size: 12px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #606060; line-height: 150%;text-align: left;">

                            If you have questions navigating this new registration process, please refer to these Frequently Asked Questions.<br>
<br>
<strong>Why do I need an account this year?</strong><br>
Our new account-based conference website gives you greater control over certain items, such as your delegate count and assignment preferences, and access to more information about your delegates during the conference.
For example, you\'ll have access to your delegates\' attendance records in real time. Our new website also helps us better address any issues during the conference because it provides a centralized communication platform.
<br>
<br>
<strong>Where can I access my account?</strong><br>
The account login page can be found at <a href="https://secure.numun.org" target="_blank" style="word-wrap: break-word;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #6DC6DD;font-weight: normal;text-decoration: underline;">account.numun.org</a>.<br>
Alternatively, you can also find a link at the top of our homepage at numun.org.&nbsp;<br>
<br>
<strong>I have more questions. Whom should I contact?</strong><br>
Please send an email to our dedicated Website Support address: support@numun.org. We will attempt to response to most emails within 24 hours.<br>
&nbsp;
                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END BODY -->
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                    <!-- BEGIN FOOTER // -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #F2F2F2;border-top: 0;border-bottom: 0;">
                                        <tr>
                                            <td align="center" valign="top" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                <table border="0" cellpadding="0" cellspacing="0" width="600" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                    <tr>
                                                        <td valign="top" class="footerContainer" style="padding-top: 10px;padding-bottom: 10px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">

                <table align="left" border="0" cellpadding="0" cellspacing="0" width="600" class="mcnTextContentContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                    <tbody><tr>

                        <td valign="top" class="mcnTextContent" style="padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #606060;font-family: Helvetica;font-size: 11px;line-height: 125%;text-align: left;">

                            <em>Copyright &copy; 2014 NUMUN. All rights reserved.</em>
<br>
    You have chosen to receive email from Northwestern University Model United Nations.
    <br>
                        </td>
                    </tr>
                </tbody></table>

            </td>
        </tr>
    </tbody>
</table></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // END FOOTER -->
                                </td>
                            </tr>
                        </table>
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>';
return $body;
	}
	
}