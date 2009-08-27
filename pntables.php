<?php

/* Wii Friends module
   Table Definitions
*/

function wiifriends_pntables()
{
  //Initialize table aray
  $pntable = array();
  
  // Console Code Table
  // For this table, 'id' is the uid of the user
  // To allow retrieval by DBUtil::selectObjectByID, as you can have only 1 console ID
  
  $pntable['wiifriends_console'] = DBUtil::getLimitedTablename('wiifriends_console');
  
  $pntable['wiifriends_console_column'] = array(
    'id'	=> 'wiifriends_console_id',
    'code'	=> 'wiifriends_console_code',
  );
   
  $pntable['wiifriends_console_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL PRIMARY',
    'code'	=> 'C(16) NOTNULL',
  );

  // Enable categorization services
  // $pntable['wiifriends_console_db_extra_enable_categorization'] = true;
  // $pntable['wiifriends_console_primary_key_column'] = 'id';

  // add standard data fields
  ObjectUtil::addStandardFieldsToTableDefinition ($pntable['wiifriends_console_column'], 'wiifriends_console_');
  ObjectUtil::addStandardFieldsToTableDataDefinition($pntable['wiifriends_console_column_def']);

  // WFC Codes Table
  $pntable['wiifriends_wfc'] = DBUtil::getLimitedTablename('wiifriends_wfc');
  
  $pntable['wiifriends_wfc_column'] = array(
    'id'	=> 'wiifriends_wfc_id',
    'game'	=> 'wiifriends_wfc_game',
    'code'	=> 'wiifriends_wfc_code',
  );
   
  $pntable['wiifriends_wfc_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL PRIMARY AUTOINCREMENT',
    'game'	=> 'I UNSIGNED NOT NULL',
    'code'	=> 'C(12) NOTNULL',
  );

  // Enable categorization services
  // $pntable['wiifriends_wfc_db_extra_enable_categorization'] = true;
  // $pntable['wiifriends_wfc_primary_key_column'] = 'id';

  // add standard data fields
  ObjectUtil::addStandardFieldsToTableDefinition ($pntable['wiifriends_wfc_column'], 'wiifriends_wfc_');
  ObjectUtil::addStandardFieldsToTableDataDefinition($pntable['wiifriends_wfc_column_def']);


  // Games Table
  $pntable['wiifriends_games'] = DBUtil::getLimitedTablename('wiifriends_games');
  
  $pntable['wiifriends_games_column'] = array(
    'id'	=> 'wiifriends_games_id',
    'game'	=> 'wiifriends_games_game',
  );
   
  $pntable['wiifriends_games_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL PRIMARY AUTOINCREMENT',
    'game'	=> 'C(255) NOTNULL',
  );

  // Enable categorization services
  // $pntable['wiifriends_games_db_extra_enable_categorization'] = true;
  // $pntable['wiifriends_games_primary_key_column'] = 'id';

  // add standard data fields
  ObjectUtil::addStandardFieldsToTableDefinition ($pntable['wiifriends_games_column'], 'wiifriends_games_');
  ObjectUtil::addStandardFieldsToTableDataDefinition($pntable['wiifriends_games_column_def']);

    
  return $pntable;

}
 