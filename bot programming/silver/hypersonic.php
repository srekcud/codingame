<? namespace Hypersonic;

/**
 * Class Entity
 *
 * @package Hypersonic
 */
class Entity
{
    protected $owner;
    protected $entityType;
    protected $line;
    protected $column;
    protected $param1;
    protected $param2;
    protected $score;
    protected $value;

    const ENTITY_TYPE_EMPTY  = -1;
    const ENTITY_TYPE_PLAYER = 0;
    const ENTITY_TYPE_BOMB   = 1;
    const ENTITY_TYPE_OBJECT = 2;

    const ENTITY_OWNER_EMPTY  = -1;
    const ENTITY_OWNER_OBJECT = 0;

    /**
     * entities constructor.
     *
     * @param        $owner
     * @param        $entityType
     * @param        $line
     * @param        $column
     * @param        $param1
     * @param        $param2
     * @param string $value
     */
    public function __construct( $owner, $entityType, $line, $column, $param1, $param2, $value = '.' )
    {
        $this->setOwner( $owner );
        $this->setEntityType( $entityType );
        $this->setLine( $line );
        $this->setColumn( $column );
        $this->setparam1( $param1 );
        $this->setparam2( $param2 );
        $this->setScore( 0 );
        $this->setValue( $value );

    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return mixed
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * @return mixed
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * @return mixed
     */
    public function getParam1()
    {
        return $this->param1;
    }

    /**
     * @return mixed
     */
    public function getParam2()
    {
        return $this->param2;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $owner
     *
     * @return $this
     */
    public function setOwner( $owner )
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @param $entityType
     *
     * @return $this
     */
    public function setEntityType( $entityType )
    {
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * @param $line
     *
     * @return $this
     */
    public function setLine( $line )
    {
        $this->line = $line;

        return $this;
    }

    /**
     * @param $column
     *
     * @return $this
     */
    public function setColumn( $column )
    {
        $this->column = $column;

        return $this;
    }

    /**
     * @param $param1
     *
     * @return $this
     */
    public function setparam1( $param1 )
    {
        $this->param1 = $param1;

        return $this;
    }

    /**
     * @param $param2
     *
     * @return $this
     */
    public function setparam2( $param2 )
    {
        $this->param2 = $param2;

        return $this;
    }

    /**
     * @param int $score
     */
    public function setScore( $score )
    {
        $this->score = $score;
    }

    /**
     * @param string $value
     */
    public function setValue( $value )
    {
        $this->value = $value;
    }
}

/**
 * Class Utilities
 *
 * @package Hypersonic
 */
class Utilities
{
    // M : ME
    // E : ENNEMY
    // B : BOMB
    // T : Target
    // . : Empty
    // S : Scope Bonus
    // C : Carry Bonus

    const WIDTH  = 13;
    const HEIGHT = 11;

    protected $bombScope;
    protected $bombCarried;
    protected $move = [0,0];

    //--------------------
    public function updateField( $field, $ent, $myId )
    {
        for( $line = 0; $line < Utilities::HEIGHT; $line++ ) {
            for( $column = 0; $column < Utilities::WIDTH; $column++ ) {
                $tmp = $field[ $line ][ $column ];
                if( $tmp == "." ) {
                    $field[ $line ][ $column ] = new Entity( Entity::ENTITY_OWNER_EMPTY, Entity::ENTITY_TYPE_EMPTY, $line, $column, -1, -1, "." );
                } elseif($tmp == "X") {
                    $field[ $line ][ $column ] = new Entity( Entity::ENTITY_OWNER_EMPTY, Entity::ENTITY_TYPE_EMPTY, $line, $column, -1, -1, "X" );
                } else{
                    $field[ $line ][ $column ] = new Entity( Entity::ENTITY_OWNER_EMPTY, Entity::ENTITY_TYPE_EMPTY, $line, $column, -1, -1, "T" );
                }
                /** @var Entity $e */
                foreach( $ent as $e ) {
                    if( $e->getLine() == $line && $e->getColumn() == $column ) {
                        if( $e->getOwner() == $myId && $e->getEntityType() == Entity::ENTITY_TYPE_PLAYER ) {
                            $e->setValue( "M" );
                            $this->bombCarried = $e->getParam1();
                            $this->bombScope = $e->getParam2();
                        } elseif( $e->getOwner() != $myId && $e->getEntityType() == Entity::ENTITY_TYPE_PLAYER ) {
                            $e->setValue( "E" );
                        } elseif( $e->getEntityType() == Entity::ENTITY_TYPE_BOMB ) {
                            $e->setValue( $e->getParam1() );
                        } elseif( $e->getEntityType() == Entity::ENTITY_TYPE_OBJECT ) {
                            ( $e->getParam1() == 1 ) ? $e->setValue( "S" ) : $e->setValue( "C" );
                        }
                        $field[ $line ][ $column ] = $e;
                    }
                }
            }
        }

        return $field;
    }




    // DEBUG FUNCTIONS--------------------------------------------------------------------------------------------------

    /**
     * @param $field
     * @param $width
     * @param $height
     */
    public function showField( $field )
    {

        $return = "";
        for( $line = 0; $line < Utilities::HEIGHT; $line++ ) {
            for( $column = 0; $column < Utilities::WIDTH; $column++ ) {
                $return .= $field[ $line ][ $column ]->getValue();
            }
            $return .= "\n ";
        }
        error_log( var_export( $return, TRUE ) );
//        error_log( var_export( "Bomb Scope : {$this->bombScope}", TRUE ) );
//        error_log( var_export( "Bomb Carried : {$this->bombCarried}", TRUE ) );

    }

    /**
     * @param        $start
     * @param        $stop
     * @param string $label
     */
    public function timeSpend( $start, $stop, $label )
    {
        $difference_ms = $stop - $start;
        error_log( var_export( "{$difference_ms} ms use for {$label}", TRUE ) );
    }
}

fscanf( STDIN, "%d %d %d", $width, $height, $myId );

// game loop
while( TRUE ) {
    $turn_start = microtime( TRUE );
    // INIT OF THE TURN
    if( TRUE ) {
        $field = $ent = [];
        $utilities = new Utilities();

        for( $i = 0; $i < $height; $i++ ) {
            fscanf( STDIN, "%s", $row );
            $field[] = str_split( $row );
        }

        fscanf( STDIN, "%d", $numberOfEntities );
        for( $i = 0; $i < $numberOfEntities; $i++ ) {
            fscanf( STDIN, "%d %d %d %d %d %d", $entityType, $owner, $x, $y, $param1, $param2 );
            $ent[] = new Entity( $owner, $entityType, $y, $x, $param1, $param2 );

        }
        $update_start = microtime( TRUE );
        $field = $utilities->updateField( $field, $ent, $myId );
        $update_end = microtime( TRUE );

        $utilities->showField( $field );


    }
    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug (equivalent to var_dump): error_log(var_export($var, true));

    echo( "MOVE 0 0\n" );

    // TIME SPEND
    $turn_end = microtime( TRUE );
    $utilities->timeSpend( $update_start, $update_end, " update the field" );
    $utilities->timeSpend( $turn_start, $turn_end, "the turn" );
}