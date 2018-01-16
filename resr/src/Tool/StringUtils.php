<?php
/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 16.01.18
 * Time: 23:23
 */

class StringUtils
{
    private static $sqlDictionary = array(
        "ADD" , "EXTERNAL" , "PROCEDURE", "ALL" , "FETCH" ,
        "PUBLIC", "ALTER" , "FILE" , "RAISERROR", "AND" , "FILLFACTOR" ,
        "READ", "ANY" , "FOR" , "READTEXT" , "AS" , "FOREIGN" , "RECONFIGURE",
        "ASC" , "FREETEXT" , "REFERENCES", "AUTHORIZATION" , "FREETEXTTABLE" ,
        "REPLICATION", "BACKUP" , "FROM" , "RESTORE" , "BEGIN" , "FULL" , "RESTRICT",
        "BETWEEN" , "FUNCTION" , "RETURN", "BREAK" , "GOTO" , "REVERT", "BROWSE" ,
        "GRANT" , "REVOKE", "BULK" , "GROUP" , "RIGHT", "BY" , "HAVING" , "ROLLBACK" ,
        "CASCADE" , "HOLDLOCK" , "ROWCOUNT", "CASE" , "IDENTITY" , "ROWGUIDCOL" , "CHECK" ,
        "IDENTITY_INSERT" , "RULE" , "CHECKPOINT" , "IDENTITYCOL" , "SAVE" , "CLOSE" , "IF" ,
        "SCHEMA" , "CLUSTERED" , "IN" , "SECURITYAUDIT" , "COALESCE" , "INDEX" , "SELECT" ,
        "COLLATE" , "INNER" , "SEMANTICKEYPHRASETABLE" , "COLUMN" , "INSERT" ,
        "SEMANTICSIMILARITYDETAILSTABLE" , "COMMIT" , "INTERSECT" , "SEMANTICSIMILARITYTABLE" ,
        "COMPUTE" , "INTO" , "SESSION_USER" , "CONSTRAINT" , "IS" , "SET" , "CONTAINS" , "JOIN" ,
        "SETUSER" , "CONTAINSTABLE" , "KEY" , "SHUTDOWN" , "CONTINUE" , "KILL" , "SOME" , "CONVERT" ,
        "LEFT" , "STATISTICS" , "CREATE" , "LIKE" , "SYSTEM_USER" , "CROSS" , "LINENO" ,
        "TABLE" , "CURRENT" , "LOAD" , "TABLESAMPLE" , "CURRENT_DATE" , "MERGE" , "TEXTSIZE" ,
        "CURRENT_TIME" , "NATIONAL" , "THEN" , "CURRENT_TIMESTAMP" , "NOCHECK" , "TO" ,
        "CURRENT_USER" , "NONCLUSTERED" , "TOP" , "CURSOR" , "NOT" , "TRAN" , "DATABASE" ,
        "NULL" , "TRANSACTION" , "DBCC" , "NULLIF" , "TRIGGER" , "DEALLOCATE" , "OF" ,
        "TRUNCATE" , "DECLARE" , "OFF" , "TRY_CONVERT" , "DEFAULT" , "OFFSETS" , "TSEQUAL" ,
        "DELETE" , "ON" , "UNION" , "DENY" , "OPEN" , "UNIQUE" , "DESC" , "OPENDATASOURCE" ,
        "UNPIVOT" , "DISK" , "OPENQUERY" , "UPDATE" , "DISTINCT" , "OPENROWSET" , "UPDATETEXT" ,
        "DISTRIBUTED" , "OPENXML" , "USE" , "DOUBLE" , "OPTION" , "USER" , "DROP" , "OR" ,
        "VALUES" , "DUMP" , "ORDER" , "VARYING" , "ELSE" , "OUTER" , "VIEW" , "END" , "OVER" ,
        "WAITFOR" , "ERRLVL" , "PERCENT" , "WHEN" , "ESCAPE" , "PIVOT" , "WHERE" , "EXCEPT" ,
        "PLAN" , "WHILE" , "EXEC" , "PRECISION" , "WITH" , "EXECUTE" , "PRIMARY" ,
        "WITHIN GROUP" , "EXISTS" , "PRINT" , "WRITETEXT" , "EXIT" , "PROC" );


    public function __construct()
    {}

    public static function testOnSql($testString){
        if ( (is_string($testString)) && (strpos($testString, ' ') !=false) && ( 2 < count(explode(" ", $testString))))
        {
            $temp_list_of_word = explode(" ", $testString);
            foreach ($temp_list_of_word as $query_word)
            {
                foreach (StringUtils::$sqlDictionary as $sql_key_word){
                    if(strtolower($query_word) == strtolower($sql_key_word)){
                        print($query_word . " = " . $sql_key_word);
                        return true;
                    }
                }
            }
        }
        return false;
    }

}