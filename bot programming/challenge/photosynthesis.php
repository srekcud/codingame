<?php

class Action
{
    protected $actionId;
    protected $actionType;
    protected $delta0;
    protected $delta1;
    protected $delta2;
    protected $delta3;
    protected $price;
    protected $tomeIndex;
    protected $taxCount;
    protected $castable;
    protected $repeatable;

    /**
     * Get the value of actionId
     */
    public function getActionId()
    {
        return $this->actionId;
    }

    /**
     * Set the value of actionId
     *
     * @return  self
     */
    public function setActionId($actionId)
    {
        $this->actionId = $actionId;

        return $this;
    }

    /**
     * Get the value of actionType
     */
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * Set the value of actionType
     *
     * @return  self
     */
    public function setActionType($actionType)
    {
        $this->actionType = $actionType;

        return $this;
    }

    /**
     * Get the value of delta0
     */
    public function getDelta0()
    {
        return $this->delta0;
    }

    /**
     * Set the value of delta0
     *
     * @return  self
     */
    public function setDelta0($delta0)
    {
        $this->delta0 = $delta0;

        return $this;
    }

    /**
     * Get the value of delta1
     */
    public function getDelta1()
    {
        return $this->delta1;
    }

    /**
     * Set the value of delta1
     *
     * @return  self
     */
    public function setDelta1($delta1)
    {
        $this->delta1 = $delta1;

        return $this;
    }

    /**
     * Get the value of delta2
     */
    public function getDelta2()
    {
        return $this->delta2;
    }

    /**
     * Set the value of delta2
     *
     * @return  self
     */
    public function setDelta2($delta2)
    {
        $this->delta2 = $delta2;

        return $this;
    }

    /**
     * Get the value of delta3
     */
    public function getDelta3()
    {
        return $this->delta3;
    }

    /**
     * Set the value of delta3
     *
     * @return  self
     */
    public function setDelta3($delta3)
    {
        $this->delta3 = $delta3;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of tomeIndex
     */
    public function getTomeIndex()
    {
        return $this->tomeIndex;
    }

    /**
     * Set the value of tomeIndex
     *
     * @return  self
     */
    public function setTomeIndex($tomeIndex)
    {
        $this->tomeIndex = $tomeIndex;

        return $this;
    }

    /**
     * Get the value of taxCount
     */
    public function getTaxCount()
    {
        return $this->taxCount;
    }

    /**
     * Set the value of taxCount
     *
     * @return  self
     */
    public function setTaxCount($taxCount)
    {
        $this->taxCount = $taxCount;

        return $this;
    }

    /**
     * Get the value of castable
     */
    public function getCastable()
    {
        return $this->castable;
    }

    /**
     * Set the value of castable
     *
     * @return  self
     */
    public function setCastable($castable)
    {
        $this->castable = $castable;

        return $this;
    }

    /**
     * Get the value of repeatable
     */
    public function getRepeatable()
    {
        return $this->repeatable;
    }

    /**
     * Set the value of repeatable
     *
     * @return  self
     */
    public function setRepeatable($repeatable)
    {
        $this->repeatable = $repeatable;

        return $this;
    }

    public function __construct($actionId, $actionType, $delta0, $delta1, $delta2, $delta3, $price, $tomeIndex, $taxCount, $castable, $repeatable)
    {
        $this->setActionId($actionId)
            ->setActionType($actionType)
            ->setDelta0($delta0)
            ->setDelta1($delta1)
            ->setDelta2($delta2)
            ->setDelta3($delta3)
            ->setPrice($price)
            ->setTomeIndex($tomeIndex)
            ->setTaxCount($taxCount)
            ->setCastable($castable)
            ->setRepeatable($repeatable);
    }
}

class Brew
{


    /**
     * ratio Rubis / nombre de tour
     * trouver un moyen de calculer le nombre de tour
     * a priori nombre de tour pour delta X =  X + 1 ( REST )
     * donc nombre de tour pour une recette = n X + ( n/2 - 2 ) recast delta0
     */
    public function getBestBrew($brewList)
    {//change this
    // error_log(var_export($brewList, true));

       usort($brewList,"sortbrewbyminprice");
    // error_log(var_export($brewList, true));

        return array_shift($brewList);
    }
}

class Cast
{
    protected $delta0CastId;
    protected $delta1CastId;
    protected $delta2CastId;
    protected $delta3CastId;

    public function getDelta0CastId()
    {
        return $this->delta0CastId;
    }
    public function getDelta1CastId()
    {
        return $this->delta1CastId;
    }
    public function getDelta2CastId()
    {
        return $this->delta2CastId;
    }
    public function getDelta3CastId()
    {
        return $this->delta3CastId;
    }

    public function setDeltaXCastId($castList,$x)
    {
        $get = "getDelta".$x;
        $d = "delta".$x."CastId";
        foreach($castList as $cast){
            if($cast->$get() > 0){$this->$d = $cast->getActionId();}
        }

        return $this;
    }

    public function castDelta0($castList)
    {
        if($castList[$this->getDelta0CastId()]->getCastable() != 1){
            $return[] = "REST\n";
        }else{
            $id = $this->getDelta0CastId();
            $return[] = "CAST {$id}\n";
        }
        return $return;
    }

    public function castDelta1($castList,$needs)
    {
        if($needs[0] < 1){
            $return = $this->castDelta0($castList);
        }elseif($castList[$this->getDelta1CastId()]->getCastable() != 1){
            $return[] = "REST\n";
        }else{
            $id = $this->getDelta1CastId();
            $return[] = "CAST {$id}\n";
        }

        return $return;

    }

    public function castDelta2($castList,$needs)
    {
        if($needs[1] < 1){
            $return = $this->castDelta1($castList,$needs);
        }elseif($castList[$this->getDelta2CastId()]->getCastable() != 1){
            $return[] = "REST\n";
        }else{
            $id = $this->getDelta2CastId();
            $return[] = "CAST {$id}\n";
        }

        return $return;

    }

    public function castDelta3($castList,$needs)
    {
        if($needs[2] < 1 ){
            $return = $this->castDelta2($castList,$needs);
        }elseif($castList[$this->getDelta3CastId()]->getCastable() != 1){
            $return[] = "REST\n";
        }else{
            $id = $this->getDelta3CastId();
            $return[] = "CAST {$id}\n";
        }

        return $return;

    }


    public function __construct($castList)
    {
        $this->setDeltaXCastId($castList,0);
        $this->setDeltaXCastId($castList,1);
        $this->setDeltaXCastId($castList,2);
        $this->setDeltaXCastId($castList,3);
    }
}

function sortbrewbyminprice($a,$b)
    {
        return($a->getPrice() < $b->getPrice()) ? -1 : 1;
    }
$turn = 1 ;
$actionList=[];
while (TRUE) {
    $castList = $brewList = [];
    // $actionCount: the number of spells and recipes in play
    fscanf(STDIN, "%d", $actionCount);
    for ($i = 0; $i < $actionCount; $i++) {
        // $actionId: the unique ID of this spell or recipe
        // $actionType: in the first league: BREW; later: CAST, OPPONENT_CAST, LEARN, BREW
        // $delta0: tier-0 ingredient change
        // $delta1: tier-1 ingredient change
        // $delta2: tier-2 ingredient change
        // $delta3: tier-3 ingredient change
        // $price: the price in rupees if this is a potion
        // $tomeIndex: in the first two leagues: always 0; later: the index in the tome if this is a tome spell, equal to the read-ahead tax
        // $taxCount: in the first two leagues: always 0; later: the amount of taxed tier-0 ingredients you gain from learning this spell
        // $castable: in the first league: always 0; later: 1 if this is a castable player spell
        // $repeatable: for the first two leagues: always 0; later: 1 if this is a repeatable player spell
        fscanf(STDIN, "%d %s %d %d %d %d %d %d %d %d %d", $actionId, $actionType, $delta0, $delta1, $delta2, $delta3, $price, $tomeIndex, $taxCount, $castable, $repeatable);

        switch ($actionType) {
            case "CAST":
                $castList[$actionId] = new Action($actionId, $actionType, $delta0, $delta1, $delta2, $delta3, $price, $tomeIndex, $taxCount, $castable, $repeatable);
                break;
            case "BREW":
                $brewList[$actionId] = new Action($actionId, $actionType, $delta0, $delta1, $delta2, $delta3, $price, $tomeIndex, $taxCount, $castable, $repeatable);
                break;
        }
    }
    // error_log(var_export($brewList, true));
    // error_log(var_export($brew[0]->getActionId(), true));
    // error_log(var_export($castList, true));

    // We are always i = 0
    for ($i = 0; $i < 2; $i++) {
        // $inv0: tier-0 ingredients in inventory
        // $score: amount of rupees
        fscanf(STDIN, "%d %d %d %d %d", $inv0, $inv1, $inv2, $inv3, $score);

        $inventory[$i] = [$inv0, $inv1, $inv2, $inv3, $score];
    }
    // error_log(var_export($inventory, true));
    $brew = new Brew();
    $cast = new Cast($castList);

    //TODO : if bbrew not in brewlist


    $bbrew = $brew->getBestBrew($brewList);
    // error_log(var_export($bbrew, true));

    $needs=[
        $bbrew->getDelta0()+$inventory[0][0],
        $bbrew->getDelta1()+$inventory[0][1],
        $bbrew->getDelta2()+$inventory[0][2],
        $bbrew->getDelta3()+$inventory[0][3],
    ];
    // error_log(var_export($needs, true));
    $castLvl = "BREW";
    for($i=0 ; $i<=3; $i++){
        if($needs[$i] < 0){
            $castLvl = $i;
        }
    }
if($castLvl!= "BREW"){
    $c = "castDelta".$castLvl;


    $ret = $cast->$c($castList,$needs);
    foreach($ret as $r){
        $actionList[] = $r;
    }
}else{
    $actionList[] = "BREW ". $bbrew->getActionId()."\n";
}
    // error_log(var_export($actionList, true));

    // To debug: error_log(var_export($var, true)); (equivalent to var_dump)


    // in the first league: BREW <id> | WAIT; later: BREW <id> | CAST <id> [<times>] | LEARN <id> | REST | WAIT
    // echo("BREW {$actions[0]["actionid"]}\n");
    $action = array_shift($actionList);
    echo ($action);

    $turn++;
}

// regarder si un sort castable est utile  --> evite un rest
// regarder pour le vrai best brew
// checker le score de l'adversaire pour savoir si c'est mieux de brew un gros socre ou pas
