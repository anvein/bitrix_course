<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", "/".basename(__FILE__)));
	
if (WIZARD_INSTALL_DEMO_DATA)	
{
		$DB->Query("UPDATE b_user SET LAST_LOGIN = ".$DB->GetNowFunction());
		COption::SetOptionString("main", "rating_assign_type", 'auto');
      $ratingId = false;
		
		$rsData = CRatings::GetList(array('ID'=>'ASC'), array('AUTHORITY'=>'N'));
		if($arRes = $rsData->Fetch())
		{
			if ($arRes['ACTIVE'] == 'N')
			{
				CRatings::Delete($arRes['ID']);
			} 
			else 
			{
				$ratingId = $arRes['ID'];
			}
		}

		if($ratingId == false){
				$arConfig = array();
		
				$arConfig['MAIN'] = array(
					'RATING' => array(
						'BONUS' => array(
							'ACTIVE' => 'Y',
							'COEFFICIENT' => '1',
						),
					),
				);
				
				$arConfig['FORUM'] = array(
					'VOTE' => array(
						'TOPIC' => array(
							'ACTIVE' => 'Y',
							'COEFFICIENT' => '0.5',
							'LIMIT' => '30'
						),
						'POST' => array(
							'ACTIVE' => 'Y',
							'COEFFICIENT' => '0.1',
							'LIMIT' => '30'
						),
					),
					'RATING' => array(
						'ACTIVITY' => array(
							'ACTIVE' => 'Y',
							'TODAY_TOPIC_COEF' => '0.4',
							'WEEK_TOPIC_COEF' => '0.2',
							'MONTH_TOPIC_COEF' => '0.1',
							'ALL_TOPIC_COEF' => '0',
							'TODAY_POST_COEF' => '0.2',
							'WEEK_POST_COEF' => '0.1',
							'MONTH_POST_COEF' => '0.05',
							'ALL_POST_COEF' => '0',
						),
					),
				);
				    
				$arConfig['BLOG'] = array(
					'VOTE' => array(
						'POST' => array(
							'ACTIVE' => 'Y',
							'COEFFICIENT' => '1',
							'LIMIT' => '30'
						),
						'COMMENT' => array(
							'ACTIVE' => 'Y',
							'COEFFICIENT' => '1',
							'LIMIT' => '30'
						),
					),
					'RATING' => array(
						'ACTIVITY' => array(
							'ACTIVE' => 'Y',
							'TODAY_POST_COEF' => '0.4',
							'WEEK_POST_COEF' => '0.2',
							'MONTH_POST_COEF' => '0.1',
							'ALL_POST_COEF' => '0',
							'TODAY_COMMENT_COEF' => '0.2',
							'WEEK_COMMENT_COEF' => '0.1',
							'MONTH_COMMENT_COEF' => '0.05',
							'ALL_COMMENT_COEF' => '0',
						),
					),
				);
			
				$arAddRating = array(
					'ACTIVE' => 'Y',
					'NAME' => GetMessage('MAIN_RATING_NAME'),
					'ENTITY_ID' => 'USER',
					'CALCULATION_METHOD' => 'SUM',
					'POSITION' => 'Y',
					'AUTHORITY' => 'N',
					'CONFIGS' => $arConfig
				);
				$ratingId = CRatings::Add($arAddRating);
		}
		

			
		$authorityId = false;
		
		$rsData = CRatings::GetList(array('ID'=>'ASC'), array('AUTHORITY'=>'Y'));
		if($arRes = $rsData->Fetch())
		{
			if ($arRes['ACTIVE'] == 'N')
			{
				CRatings::Delete($arRes['ID']);
			} 
			else 
			{
				$authorityId = $arRes['ID'];
			}
		} 
		if($authorityId == false) {
			$arConfig = array();
		
				$arConfig['MAIN'] = array(
					'VOTE' => array(
						'USER' => array(
							'ACTIVE' => 'Y',
							'COEFFICIENT' => '1',
							'LIMIT' => '30'
						),
					),
					'RATING' => array(
						'BONUS' => array(
							'ACTIVE' => 'Y',
							'COEFFICIENT' => '1',
						),
					),
				);
							
				$arAddRating = array(
					'ACTIVE' => 'Y',
					'NAME' => GetMessage('MAIN_RATING_AUTHORITY'),
					'ENTITY_ID' => 'USER',
					'CALCULATION_METHOD' => 'SUM',
					'POSITION' => 'Y',
					'AUTHORITY' => 'Y',
					'CONFIGS' => $arConfig
				);
				$authorityId = CRatings::Add($arAddRating);
		}
		
		$strSql = "
			INSERT INTO b_rating_user (ENTITY_ID, RATING_ID)
			SELECT 
				u.ID, '$authorityId'
			FROM 
				b_user u 
				LEFT JOIN b_rating_user ru ON ru.RATING_ID = $authorityId AND ru.ENTITY_ID = u.ID 
			WHERE 
				ru.ENTITY_ID IS NULL";
		$DB->Query($strSql, false, $err_mess.__LINE__);  
		
		$arParams = array();
      $arParams['DEFAULT_CONFIG_NEW_USER'] = 'Y';
      CRatings::SetAuthorityDefaultValue($arParams);
		
		COption::SetOptionString("main", "rating_normalization", 10);
		COption::SetOptionString("main", "rating_community_size", 1);	
		COption::SetOptionString("main", "rating_community_authority", 30);
		COption::SetOptionString("main", "rating_vote_weight", 10);	
		
		CRatings::Calculate($authorityId, true);
		CRatings::Calculate($ratingId, true);
		
		COption::SetOptionString("main", "rating_vote_type", 'standart');
		COption::SetOptionString("socialnetwork", "tooltip_rating_id", serialize(array($ratingId, $authorityId)), "", WIZARD_SITE_ID); 
		COption::SetOptionString("socialnetwork", "tooltip_show_rating", "Y", "", WIZARD_SITE_ID);
		COption::SetOptionString("forum", "SHOW_VOTES", "N");
}
?>