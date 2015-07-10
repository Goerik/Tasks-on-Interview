<?

/**
 * Экземпляр этого класса решает первую тестовую задачу
 *
 * <code>
 * require_once 'init.php';
 * 
 * $ex = new init();
 * $ex->get();
 * </code>
 *
 * @author Albert Umerov <albert@veryware.org>
 */

final class init
{
	 /**
     * Подключение к БД
     *
     * @var PDO Connection
     */
     private $conn;

	 /**
     * Конструктор - устанавливает подлючение к БД, создает таблицу test и заполняет её тестовым данными
     */
     function __construct() {
       $this->conn = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8', 'root', 'm34>DL');

       $this->create();
       $this->fill();
   	}

    /**
     * Создает таблицу test
     */
    private function create()
    {
        
		$createQuery = <<<EOD
	DROP TABLE IF EXISTS `mydb`.`test` ;

	CREATE TABLE IF NOT EXISTS `mydb`.`test` (
	  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	  `script_name` VARCHAR(25) NULL,
	  `start_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	  `sort_index` DECIMAL(3,0) NULL,
	  `result` ENUM('normal','illegal','failed','success') NULL,
	  PRIMARY KEY (`id`),
	  INDEX `result` (`result` ASC))
	ENGINE = InnoDB;
EOD;

		$query = $this->conn->prepare($createQuery);
		$query->execute();

    }
    
     /**
     * Заполняет таблицу test случайными данными
     */
    private function fill()
    {
		$insertQuery = "INSERT INTO `mydb`.`test` (`script_name`, `sort_index`, `result`) VALUES (:script_name, :sort_index, :result);";
		$query = $this->conn->prepare($insertQuery);

		$resultVarians = array('normal','illegal','failed','success');


		
		for ($i=0; $i < 100; $i++) { 
			$result = $resultVarians[rand(0, 3)];
			$sort = rand(100,999);

			$params = array('script_name'=>'test/' . rand(), 'sort_index'=>$sort, 'result'=>$result);
			$query->execute($params);
		}
    }

    /**
     * Получает и выводит данные из таблицы test, у которых поле result среди ('normal','success')
     */
    public function get()
    {
        $selectQuery = "SELECT * FROM mydb.test where result in ('normal','success');";

        foreach ($this->conn->query($selectQuery) as $row){
        	echo $row['id'] .";" . $row['script_name'] .";" . $row['start_time'] .";" . $row['sort_index'] .";" . $row['result'] . "\n";
        }
    }
}


?>