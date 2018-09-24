<?php namespace App\Persistence;

use App\Exceptions\PersistenceException;
use App\Includes\Singleton;
use App\Model\People;

class PersistenceSingleton
{
    private static $dummy = array();
    private static $instance;

    // Singleton instance

    /**
     * @return Singleton
     */
    public static function getInstance()
    {
        if (!isset( self::$instance )) {
            $myClass = __CLASS__;
            self::$instance = new $myClass;
        }
        return self::$instance;
    }

    public function __clone() { trigger_error("Clone of this class is forbidden"); }

    private function __construct() {
         self::$dummy = array(
            array("name"=>"Warren","email"=>"erat.Sed.nunc@ascelerisque.co.uk","date"=>"06/16/2019","address"=>"Ap #493-7473 Enim. Road","location"=>"-21.42349, 85.76285"),
            array("name"=>"Rafael","email"=>"et@sem.com","date"=>"07/15/2019","address"=>"Ap #125-1843 Sed Av.","location"=>"54.62019, 14.06996"),
            array("name"=>"Stuart","email"=>"ac.risus.Morbi@lacusvestibulum.com","date"=>"01/31/2018","address"=>"Ap #336-5469 Non Street","location"=>"-83.39054, -63.72079"),
            array("name"=>"Hedley","email"=>"congue@semmagna.com","date"=>"10/06/2017","address"=>"791-7234 Laoreet Rd.","location"=>"58.06893, 24.01848"),
            array("name"=>"Elton","email"=>"mi.enim@mollisnoncursus.com","date"=>"05/06/2018","address"=>"Ap #264-8794 Ac Avenue","location"=>"-82.08907, -71.027"),
            array("name"=>"Kenneth","email"=>"Fusce.dolor.quam@sitamet.org","date"=>"01/29/2019","address"=>"P.O. Box 689, 1073 Arcu Rd.","location"=>"-74.61924, 42.08174"),
            array("name"=>"Driscoll","email"=>"ornare.egestas@ametante.org","date"=>"12/20/2018","address"=>"P.O. Box 770, 8819 Vestibulum Street","location"=>"-37.92786, -40.41964"),
            array("name"=>"Denton","email"=>"ac.feugiat@neceleifendnon.com","date"=>"02/26/2019","address"=>"5821 Et St.","location"=>"72.70548, -30.16087"),
            array("name"=>"Jeremy","email"=>"lobortis@Cras.org","date"=>"10/26/2017","address"=>"P.O. Box 392, 4523 Molestie St.","location"=>"-11.93182, 112.18299"),
            array("name"=>"Henry","email"=>"mauris@Nuncsedorci.co.uk","date"=>"06/06/2019","address"=>"P.O. Box 711, 9918 Nulla Street","location"=>"27.81814, -67.64384"),
            array("name"=>"Garth","email"=>"convallis.est.vitae@Crasdolor.org","date"=>"05/15/2019","address"=>"4712 Odio, Avenue","location"=>"-32.96859, -147.79604"),
            array("name"=>"Rajah","email"=>"mauris@sedpedenec.ca","date"=>"05/19/2018","address"=>"628-4023 Fusce St.","location"=>"72.80271, 39.33884"),
            array("name"=>"Kamal","email"=>"eu.arcu.Morbi@nislsemconsequat.edu","date"=>"02/05/2018","address"=>"P.O. Box 637, 3707 Cubilia Avenue","location"=>"1.72427, -109.6417"),
            array("name"=>"Byron","email"=>"nunc.sit@mipede.co.uk","date"=>"11/06/2017","address"=>"5786 Praesent St.","location"=>"73.80857, -132.02888"),
            array("name"=>"Elvis","email"=>"a.ultricies.adipiscing@sitamet.com","date"=>"05/06/2019","address"=>"Ap #212-9532 Duis Street","location"=>"11.15032, -49.25204"),
            array("name"=>"Harding","email"=>"tincidunt@Duis.ca","date"=>"07/07/2019","address"=>"943-1082 Neque. Ave","location"=>"-52.56024, 114.18912"),
            array("name"=>"Joseph","email"=>"Duis.risus.odio@fringillaornareplacerat.net","date"=>"04/06/2019","address"=>"9919 Tincidunt Road","location"=>"-37.85416, 15.85954"),
            array("name"=>"Quinlan","email"=>"orci.sem@egestasAliquam.net","date"=>"09/29/2018","address"=>"4645 Dignissim St.","location"=>"3.33403, -135.13149"),
            array("name"=>"Dane","email"=>"dolor@fringillaornareplacerat.com","date"=>"02/18/2019","address"=>"733-1419 Ac, Rd.","location"=>"-89.85842, 159.98708"),
            array("name"=>"Jackson","email"=>"senectus.et.netus@dolor.co.uk","date"=>"10/13/2018","address"=>"5475 Turpis Road","location"=>"52.22048, 146.59268"),
            array("name"=>"Brendan","email"=>"amet.luctus@vestibulum.org","date"=>"05/25/2019","address"=>"4831 Proin St.","location"=>"-18.16533, 113.77796"),
            array("name"=>"Kane","email"=>"lorem.Donec@nequeSedeget.com","date"=>"08/14/2018","address"=>"Ap #935-1929 Ut Ave","location"=>"-32.7828, 51.3992"),
            array("name"=>"Tiger","email"=>"faucibus@tristique.com","date"=>"07/18/2019","address"=>"P.O. Box 675, 8364 Odio Road","location"=>"-88.06465, 26.49675"),
            array("name"=>"Judah","email"=>"accumsan.neque.et@cubilia.co.uk","date"=>"11/16/2018","address"=>"4039 Ipsum Ave","location"=>"-8.10634, 132.02009"),
            array("name"=>"Macaulay","email"=>"ligula.Nullam.feugiat@Etiam.net","date"=>"04/15/2018","address"=>"571-4758 Ante Avenue","location"=>"-46.81927, -102.29028"),
            array("name"=>"Perry","email"=>"enim.gravida@Aliquamrutrum.ca","date"=>"11/23/2018","address"=>"594 Nibh. Av.","location"=>"77.10998, 59.00995"),
            array("name"=>"Kareem","email"=>"tortor@Pellentesque.com","date"=>"03/08/2019","address"=>"P.O. Box 659, 1135 Magna Avenue","location"=>"12.99673, 166.84956"),
            array("name"=>"Chaney","email"=>"sem.molestie.sodales@facilisis.com","date"=>"01/03/2019","address"=>"P.O. Box 259, 9718 Non Rd.","location"=>"-40.86695, -132.2643"),
            array("name"=>"Adam","email"=>"eu@venenatisvelfaucibus.edu","date"=>"01/06/2019","address"=>"P.O. Box 310, 5208 Hendrerit Ave","location"=>"67.99989, -64.6686"),
            array("name"=>"Murphy","email"=>"pellentesque@mi.org","date"=>"03/17/2018","address"=>"Ap #334-9644 Adipiscing Ave","location"=>"-63.5676, -103.55361"),
            array("name"=>"Harlan","email"=>"lacus.Ut.nec@leoCras.net","date"=>"02/10/2019","address"=>"P.O. Box 466, 1993 Curabitur St.","location"=>"-56.693, 169.66478"),
            array("name"=>"Timon","email"=>"ut.ipsum.ac@etnunc.org","date"=>"02/13/2018","address"=>"934-4253 In Rd.","location"=>"-15.24772, -158.88457"),
            array("name"=>"Kieran","email"=>"ipsum.non@estarcuac.ca","date"=>"07/31/2018","address"=>"432-9000 Interdum. Ave","location"=>"-4.71296, -167.38091"),
            array("name"=>"Baxter","email"=>"vulputate.velit@lobortis.ca","date"=>"03/05/2019","address"=>"6871 In Rd.","location"=>"65.37601, -179.74598"),
            array("name"=>"Merritt","email"=>"ante.ipsum@pharetraQuisque.ca","date"=>"11/14/2017","address"=>"P.O. Box 593, 1133 Mollis Avenue","location"=>"-35.03462, -31.94566"),
            array("name"=>"Emerson","email"=>"nec@semper.ca","date"=>"11/13/2018","address"=>"P.O. Box 221, 9089 Nascetur Road","location"=>"79.33724, 23.73195"),
            array("name"=>"Paki","email"=>"nec.eleifend@ametmassa.co.uk","date"=>"08/07/2018","address"=>"1121 Ornare. Ave","location"=>"7.34666, -128.85729"),
            array("name"=>"Leroy","email"=>"id.nunc.interdum@ligulatortordictum.org","date"=>"06/20/2019","address"=>"Ap #479-6604 Fringilla Street","location"=>"21.95417, 112.18188"),
            array("name"=>"Ulysses","email"=>"scelerisque.mollis.Phasellus@veliteu.edu","date"=>"12/31/2017","address"=>"2813 Sit Ave","location"=>"-87.51477, -41.52511"),
            array("name"=>"Connor","email"=>"arcu.Morbi@eulacusQuisque.org","date"=>"11/27/2018","address"=>"225-3165 Odio Av.","location"=>"-44.6897, -167.1125"),
            array("name"=>"Kadeem","email"=>"at.velit.Cras@ascelerisque.net","date"=>"01/02/2018","address"=>"Ap #519-3631 Tempor St.","location"=>"-11.968, 137.80218"),
            array("name"=>"Uriah","email"=>"in@risusquis.co.uk","date"=>"04/21/2018","address"=>"8718 Cras St.","location"=>"-75.76454, 15.67377"),
            array("name"=>"Dieter","email"=>"feugiat.Lorem@Integeridmagna.net","date"=>"04/19/2018","address"=>"967-4666 Sed, Av.","location"=>"-8.61777, -100.68725"),
            array("name"=>"Malcolm","email"=>"ullamcorper.viverra@Fuscemi.ca","date"=>"02/13/2018","address"=>"P.O. Box 201, 3372 Fringilla St.","location"=>"-25.91769, 163.45129"),
            array("name"=>"Carl","email"=>"non.lorem.vitae@Crasvehicula.ca","date"=>"05/04/2018","address"=>"384-592 Aliquet Rd.","location"=>"-56.49009, 107.59364"),
            array("name"=>"Phelan","email"=>"eu.euismod@dapibusligulaAliquam.edu","date"=>"07/22/2019","address"=>"Ap #272-1866 Mi Ave","location"=>"55.50349, -63.38529"),
            array("name"=>"Ishmael","email"=>"est.vitae@purusaccumsan.ca","date"=>"10/30/2017","address"=>"4472 Sed Rd.","location"=>"-81.74446, 4.39069"),
            array("name"=>"Colton","email"=>"augue@Phasellus.edu","date"=>"07/30/2019","address"=>"P.O. Box 463, 6982 Vulputate, St.","location"=>"38.83624, -21.82675"),
            array("name"=>"Raymond","email"=>"et.ultrices@erosnon.net","date"=>"07/30/2018","address"=>"4189 Integer Ave","location"=>"77.0785, 167.83346"),
            array("name"=>"Alan","email"=>"vel.arcu@nec.ca","date"=>"09/04/2018","address"=>"P.O. Box 787, 1306 Aenean Road","location"=>"1.57234, -14.93106"),
            array("name"=>"Quinn","email"=>"gravida.nunc.sed@Vestibulumante.edu","date"=>"06/19/2018","address"=>"Ap #189-8360 Dui. St.","location"=>"1.95537, -105.17891"),
            array("name"=>"Clayton","email"=>"in@ultriciessem.net","date"=>"03/14/2019","address"=>"910-5451 Tristique Avenue","location"=>"12.10026, -124.33716"),
            array("name"=>"Graiden","email"=>"Aliquam.ultrices@vitaediam.com","date"=>"12/18/2018","address"=>"Ap #611-8341 Tempus Rd.","location"=>"-89.34703, -135.35115"),
            array("name"=>"Brock","email"=>"Nulla.aliquet@Aliquam.org","date"=>"04/29/2019","address"=>"3463 Aenean Street","location"=>"-27.67965, -147.75214"),
            array("name"=>"Judah","email"=>"nibh.enim.gravida@mauriseuelit.ca","date"=>"08/22/2018","address"=>"4015 Enim Rd.","location"=>"-1.24218, -53.76126"),
            array("name"=>"Bernard","email"=>"ut@Integer.edu","date"=>"08/29/2018","address"=>"791-2854 Habitant Ave","location"=>"27.44392, -179.85828"),
            array("name"=>"Carter","email"=>"feugiat.nec@etmalesuadafames.net","date"=>"03/23/2019","address"=>"P.O. Box 597, 5159 Pede, Rd.","location"=>"21.28591, -106.54348"),
            array("name"=>"John","email"=>"lectus.quis.massa@placerat.com","date"=>"07/08/2018","address"=>"125-2763 Eget, Street","location"=>"33.60961, 50.11936"),
            array("name"=>"Cameron","email"=>"mollis.Integer.tincidunt@mollisnoncursus.com","date"=>"06/01/2019","address"=>"3858 Mauris Road","location"=>"18.16084, -14.32009"),
            array("name"=>"Andrew","email"=>"non@Aenean.edu","date"=>"12/04/2017","address"=>"P.O. Box 870, 7858 Viverra. Road","location"=>"-2.95061, 108.18375"),
            array("name"=>"Fritz","email"=>"id.ante.Nunc@erategetipsum.edu","date"=>"06/19/2018","address"=>"P.O. Box 915, 3886 Convallis Av.","location"=>"37.7139, 117.51008"),
            array("name"=>"Ulric","email"=>"Nunc.pulvinar.arcu@aliquetnec.ca","date"=>"05/09/2018","address"=>"774-2136 Odio Rd.","location"=>"2.85697, -61.42149"),
            array("name"=>"Francis","email"=>"felis.adipiscing@ultrices.net","date"=>"02/16/2018","address"=>"1005 Eu, St.","location"=>"38.70767, 165.5083"),
            array("name"=>"Clinton","email"=>"facilisis.Suspendisse@egestasFuscealiquet.co.uk","date"=>"07/12/2019","address"=>"Ap #388-3325 Ut St.","location"=>"53.93505, -9.20609"),
            array("name"=>"Jin","email"=>"massa.lobortis@tinciduntorci.net","date"=>"01/23/2018","address"=>"Ap #956-8560 Sapien. St.","location"=>"84.50444, 61.29113"),
            array("name"=>"Mufutau","email"=>"Donec.est@eget.org","date"=>"06/26/2018","address"=>"P.O. Box 264, 7316 Curabitur Ave","location"=>"-31.76578, 30.98904"),
            array("name"=>"Thor","email"=>"tellus.imperdiet@diam.edu","date"=>"02/12/2018","address"=>"181-5487 Eget, Rd.","location"=>"-66.19092, -122.8433"),
            array("name"=>"Colin","email"=>"Duis@egestasnuncsed.com","date"=>"03/28/2018","address"=>"P.O. Box 737, 7332 Dolor. Ave","location"=>"-79.46249, -42.47156"),
            array("name"=>"Baxter","email"=>"habitant.morbi.tristique@Nullafacilisi.edu","date"=>"05/23/2019","address"=>"3435 Mollis Ave","location"=>"42.56187, -153.75781"),
            array("name"=>"Hector","email"=>"eu.lacus@interdum.net","date"=>"09/01/2019","address"=>"152-4526 Malesuada St.","location"=>"-9.28503, -120.88786"),
            array("name"=>"Gray","email"=>"scelerisque.scelerisque.dui@orciinconsequat.org","date"=>"12/30/2018","address"=>"5004 Suspendisse Rd.","location"=>"52.59458, -78.47202"),
            array("name"=>"Magee","email"=>"vel.pede@ultriciesdignissim.com","date"=>"10/02/2017","address"=>"871-7682 Magna Rd.","location"=>"-60.41185, 47.67354"),
            array("name"=>"Rafael","email"=>"sagittis@volutpat.edu","date"=>"03/11/2018","address"=>"1080 Eu Ave","location"=>"79.53141, 173.34222"),
            array("name"=>"Emmanuel","email"=>"amet.ornare.lectus@eleifend.edu","date"=>"02/18/2019","address"=>"P.O. Box 873, 9574 Congue Rd.","location"=>"-89.43786, -54.52482"),
            array("name"=>"Carson","email"=>"et@ipsumcursusvestibulum.org","date"=>"08/25/2019","address"=>"Ap #527-7231 Aliquam St.","location"=>"89.1448, 139.6253"),
            array("name"=>"Mark","email"=>"eu.augue@Suspendisse.com","date"=>"07/11/2018","address"=>"P.O. Box 365, 4901 Sem Avenue","location"=>"-39.35367, 10.64795"),
            array("name"=>"Stephen","email"=>"Nunc.ut@temporeratneque.co.uk","date"=>"12/21/2018","address"=>"Ap #484-1108 Consequat Rd.","location"=>"66.90858, 90.12098"),
            array("name"=>"Lane","email"=>"mi.felis@Crasdolor.ca","date"=>"10/03/2017","address"=>"550-4120 Magna Road","location"=>"21.9238, -66.69558"),
            array("name"=>"Driscoll","email"=>"amet@Etiam.com","date"=>"12/04/2018","address"=>"7045 Ultrices Avenue","location"=>"27.7018, -7.23893"),
            array("name"=>"Rooney","email"=>"imperdiet@cubiliaCuraeDonec.edu","date"=>"06/11/2018","address"=>"6005 Sem Rd.","location"=>"-86.42799, 97.6319"),
            array("name"=>"Todd","email"=>"magna.Cras.convallis@condimentum.co.uk","date"=>"12/31/2017","address"=>"P.O. Box 922, 5553 Auctor Av.","location"=>"58.3853, -35.59701"),
            array("name"=>"Moses","email"=>"mattis.velit.justo@malesuadafames.org","date"=>"12/20/2018","address"=>"7667 Eu Street","location"=>"-15.50737, 148.48711"),
            array("name"=>"Neville","email"=>"non.feugiat@Donec.com","date"=>"08/26/2018","address"=>"1316 In, Street","location"=>"50.17491, 21.93291"),
            array("name"=>"Kamal","email"=>"vel@ac.edu","date"=>"11/29/2017","address"=>"Ap #971-3668 Imperdiet Road","location"=>"-23.39178, -156.82434"),
            array("name"=>"Colorado","email"=>"ac.turpis@sociisnatoquepenatibus.co.uk","date"=>"08/31/2018","address"=>"669-6474 Erat Rd.","location"=>"-38.96818, 82.0032"),
            array("name"=>"Shad","email"=>"erat.Etiam@Phasellusinfelis.ca","date"=>"02/26/2019","address"=>"P.O. Box 358, 3826 Justo. Rd.","location"=>"21.84512, 78.91482"),
            array("name"=>"Clark","email"=>"ultrices@primisin.ca","date"=>"08/29/2018","address"=>"Ap #862-4744 Ut, St.","location"=>"-76.57649, 167.672"),
            array("name"=>"Burton","email"=>"lorem.auctor@ametmassa.edu","date"=>"10/05/2018","address"=>"Ap #252-5143 Risus. Av.","location"=>"38.98749, -6.75187"),
            array("name"=>"Mohammad","email"=>"Curabitur@eget.org","date"=>"05/24/2019","address"=>"9185 Sed St.","location"=>"-7.14936, -135.8586"),
            array("name"=>"Cedric","email"=>"non.lacinia.at@Duiscursus.edu","date"=>"02/19/2019","address"=>"Ap #740-1079 Cursus Road","location"=>"-59.95719, 96.02405"),
            array("name"=>"Cruz","email"=>"nec@purus.edu","date"=>"09/22/2018","address"=>"Ap #929-3806 Tempus St.","location"=>"77.31701, 43.2073"),
            array("name"=>"Mason","email"=>"arcu@Nam.net","date"=>"03/04/2018","address"=>"114-8047 Tempor Street","location"=>"-32.35762, 89.05746"),
            array("name"=>"Kyle","email"=>"nisi.magna@tellusPhaselluselit.org","date"=>"01/20/2018","address"=>"Ap #955-2877 Mauris. Street","location"=>"-54.42274, -23.10272"),
            array("name"=>"Alden","email"=>"nec.tempus@Quisque.net","date"=>"09/20/2018","address"=>"Ap #488-374 Mollis Avenue","location"=>"-88.22371, 157.18386"),
            array("name"=>"Cedric","email"=>"pede.et.risus@disparturient.co.uk","date"=>"03/27/2018","address"=>"443-2128 Aliquet, St.","location"=>"-53.87296, 70.47192"),
            array("name"=>"Jesse","email"=>"Nulla.eget@Integer.co.uk","date"=>"12/20/2018","address"=>"143-4801 Imperdiet Av.","location"=>"29.16293, 70.92812"),
            array("name"=>"Edward","email"=>"bibendum.Donec.felis@maurisrhoncus.edu","date"=>"01/31/2018","address"=>"P.O. Box 852, 8702 Ligula Rd.","location"=>"-17.82616, -30.59946"),
            array("name"=>"Aquila","email"=>"dignissim@vel.com","date"=>"08/26/2019","address"=>"4022 Interdum Ave","location"=>"73.57704, 114.49411"),
            array("name"=>"Tanek","email"=>"ac.mi.eleifend@quispedeSuspendisse.edu","date"=>"09/02/2019","address"=>"989-2348 Praesent Street","location"=>"63.32225, -40.64413"),
            array("name"=>"Drew","email"=>"adipiscing.Mauris@nullaante.edu","date"=>"09/19/2018","address"=>"Ap #338-387 Nunc Road","location"=>"65.00189, -53.80134")
        );
    }


    public function getAll(){
        return self::$dummy;
    }

    /**
     * @param $people People
     */
    public function addPeople( $people ){
//        self::$dummy[] = [
//            array(
//                "name" => $name,
//                "email" => $email,
//                "date" => $date,
//                "address" => $address,
//                "location" => "")
//        ];

        // Fast alternative
        $array =  (array) $people;
        self::$dummy[] = $array;
    }

    /**
     * @param $name String people name to delete
     *
     * @return bool|array FALSE is does not exist, array if exist
     */
    public function searchPeople( $name ){
        foreach ( self::$dummy as $people ){
            if( $people['name'] === $name )
                return $people;
        }
        return false;
    }

    /**
     * @param $name String people name to delete
     *
     * @return bool TRUE is name was found, FALSE if name does not exist
     */
    public function deletePeople( $name ){
        $cont = 0;
        foreach ( self::$dummy as $d ){
            if( $d['name'] === $name ){
                unset( self::$dummy[$cont] );
                return true;
            }
            else
                $cont += 1;
        }
        return false;
    }

    /**
     * @throws PersistenceException
     */
    public function doThrow(){
        throw new PersistenceException("A PersistenceException Test");
    }

}