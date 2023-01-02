<?php
// DB table to use
$table = 'users';
 
// Table's primary key
$primaryKey = 'id';

// indexes
$columns = array(
    array( 'db' => 'name', 'dt' => 0 ),
    array( 'db' => 'email',  'dt' => 1 ),
    array( 'db' => 'username',   'dt' => 2 ),
    array( 'db' => 'mobile', 'dt' => 3,),
    array( 'db' => 'usertype','dt' => 4,),
	array( 'db' => 'status', 'dt' => 5,),
    array( 'db' => 'lastlogin','dt' => 6,
        'formatter' => function( $d, $row ) {
			return date( 'd-m-Y', strtotime($d));
        }
    ) 
);
 
// SQL server connection information
$sql_details = array(
    'host' => 'localhost',
    'user' => 'thaimaicloudonwe_thaimai',
    'pass' => 'JUYL7#;nlLSH',
    'db'   => 'thaimaicloudonwe_thaimai'
);

require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);