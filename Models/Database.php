<?php 
require_once('Models/Products.php');
require_once('Models/Category.php');
require_once('Models/UserDatabase.php');

    class DbContext {
        private $pdo;
        private $usersDatabase;
        function getAllUsersFromDatabase(){
            return $this->usersDatabase;
        }

        function __construct(){
            $host = $_ENV['host'];
            $db = $_ENV['db'];
            $user = $_ENV['user'];
            $pass = $_ENV['pass'];

            $dns = "mysql:host=$host;dbname=$db";
            $this->pdo = new PDO($dns,$user, $pass);
            $this->usersDatabase = new UserDatabase($this->pdo);
            $this->createTablesIfNotExists();
            $this->creatingData();   
        }

        function getAllCategories(){
            return $this->pdo->query('SELECT * FROM Category')->fetchAll(PDO::FETCH_CLASS, 'Category');
        }
        
    function searchProducts($sortCol, $sortOrder, $q, $categoryId){
        if($sortCol == null){
            $sortCol = "id";
        }
        if($sortOrder == null){
            $sortOrder = "asc";
        }

        $sql = "SELECT * FROM Products ";
        $paramsArray = [];
        $addedWhere = false;
        if($q != null && strlen($q) > 0){  
            if(!$addedWhere){
                $sql = $sql . " WHERE ";
                $addedWhere = true;
            }else {
                $sql = $sql . " AND ";
            }
        $sql = $sql . " ( title like :q";        
        $sql = $sql . " OR  color like :q";             
        $sql = $sql . " OR  price like :q )";        
        $paramsArray["q"] = '%' . $q . '%';  
    }

    if($categoryId != null && strlen($categoryId) > 0){
        if(!$addedWhere){
            $sql = $sql . " WHERE ";
            $addedWhere = true;
        }else {
            $sql = $sql . " AND ";
        }
        $sql = $sql . " ( categoryId = :categoryId )";
        $paramsArray["categoryId"] = $categoryId;  
    }
    
        $sql .= " ORDER BY $sortCol $sortOrder ";    

        $prep = $this->pdo->prepare($sql);
        $prep->setFetchMode(PDO::FETCH_CLASS,'Products');
        $prep->execute($paramsArray);



        return $prep->fetchAll();       
    }    

    function getPopularyProducts(){
        return $this->pdo->query('SELECT * FROM Products WHERE populary >= 5')->fetchAll(PDO::FETCH_CLASS,'Products');
    }

    function createProductData($img, $title, $model, $color, $price, $populary, $categoryId) {
        $category = $this->getCategoryByName($categoryId);
        if ($category) {
          
            $category = $this->getCategoryByName($categoryId);
        }
    
        $existing = $this->getProductByName($title);
        if ($existing) {
            return;
        }
    
        return $this->addProduct($img, $title, $model, $price, $color, $populary, $category->id);
    }
    function getProductByName($title){
        $prep = $this->pdo->prepare('SELECT * FROM Products WHERE title=:title');
        $prep->setFetchMode(PDO::FETCH_CLASS, 'Products');
        $prep->execute(['title'=> $title]);
        return $prep->fetch();
    }

    function getProducts($id){
        $prep = $this->pdo->prepare('SELECT * FROM Products WHERE id=:id');
        $prep->setFetchMode(PDO::FETCH_CLASS, 'Products');
        $prep->execute(['id'=> $id]);
        return $prep->fetch();
    }

    function addProduct ($img, $title, $model, $price, $color, $populary, $categoryId){
        $prep = $this->pdo->prepare("INSERT INTO Products (Img, Title, Model, Price, Color, Populary, CategoryId) VALUES (:Img, :Title, :Model, :Price, :Color, :Populary, :CategoryId)");
    
        $prep->execute(["Img"=>$img, "Title"=>$title, "Model"=>$model, "Price"=>$price, "Color"=>$color, "Populary"=>$populary, "CategoryId"=>$categoryId]);
        return $this->pdo->lastInsertId();
    }

    function getCategoryByName ($name){
        $prep = $this->pdo->prepare('SELECT * FROM Category WHERE name=:name');
        $prep->setFetchMode(PDO::FETCH_CLASS, 'Category');
        $prep->execute(['name'=> $name]);
        return $prep->fetch();
    }

    function getCategory($id){
        $prep = $this->pdo->prepare('SELECT * FROM Category WHERE id=:id');
        $prep->setFetchMode(PDO::FETCH_CLASS, 'Category');
        $prep->execute(['id'=>$id]);
        return $prep->fetch();
    }
    
    function addCategories ($name) {
        $prep = $this ->pdo->prepare('INSERT INTO Category (name) VALUES(:name)');
        $prep->execute(["name"=>$name]);
        return $this->pdo->lastInsertId();
    }


        function creatingData () {
            static $data = false;
            if($data) return;
            
            $categories = $this->getAllCategories();
            $this->createProductData('assets/Sport/Sports/Bmw M2.png', 'Bmw M2', 2021, 'Silver', '678 995', 10, 'SPORT BILAR');
            $this->createProductData('assets/Sport/Sports/Porsche 911 GT3 RS.png', 'Porsche 911 GT3 RS', 2018, 'röd', '2 650 000', 10, 'SPORT BILAR');
            $this->createProductData('assets/Sport/Sports/Lambo Huracan.png', 'Lamborghini Huracan', 2024, 'Blå', '1 650 000', 9, 'SPORT BILAR');
            $this->createProductData('assets/Sport/Sports/Jaguar F-Type.png', 'Jaguar F-Type', 2023, 'Silver', '854 096', 9, 'SPORT BILAR');
            $this->createProductData('assets/Sport/Sports/Lambo Aventador.png', 'Lamborghini Aventador', 2022, 'Blå', '2 854 096', 2, 'SPORT BILAR');
            $this->createProductData('assets/Sport/Sports/Audi R8.png', 'Audi R8', 2024, 'Grön', '1 151 000', 1, 'SPORT BILAR');
            $this->createProductData('assets/Sport/Sports/Ford Mustang GT.png', 'Ford Mustang GT', 2020, 'Svart', '539 096', 2, 'SPORT BILAR');
            $this->createProductData('assets/Sport/Sports/Bmw M5.png', 'Bmw M5', 2023, 'Gul', '1 349 096', 3, 'SPORT BILAR');
            $this->createProductData('assets/Sport/Sports/Nissan GTR.png', 'Nissan GTR', 2020, 'Svart', '854 096', 4, 'SPORT BILAR');
            $this->createProductData('assets/Sport/Sports/Aston MARTIN VANTAGE.png', 'Aston MARTIN VANTAGE', 2019, 'Blå', '954 096', 3, 'SPORT BILAR');
            $this->createProductData('assets/Sport/Sports/Bmw I8.png', 'Bmw I8', 2024, 'Svart', '1 254 096', 2, 'SPORT BILAR');
            $this->createProductData('assets/Sport/Sports/Bugatti Chiron.png', 'Bugatti Chiron', 2021, 'Svart', '30 254 096', 8, 'SPORT BILAR');
            
         

            $this->createProductData('assets/Suvs/Volvo XC90.png', 'Volvo CX90', 2023, 'Dark Blue', '766 000', 3, 'SUV BILAR');
            $this->createProductData('assets/Suvs/Audi Q5.png', 'Audi Q5', 2023, 'White', '324 675', 3, 'SUV BILAR');
            $this->createProductData('assets/Suvs/Porsche Cayenne.png', 'Porsche Cayenne', 2022, 'Grey', '666 000', 4, 'SUV BILAR');
            $this->createProductData('assets/Suvs/Bmw MX5.png', 'Bmw MX5', 2024, 'Blue', '1 020 000', 9, 'SUV BILAR');
            $this->createProductData('assets/Suvs/Volvo XC60.png', 'Volvo CX60', 2022, 'Dark Blue', '296 000', 6, 'SUV BILAR');
            $this->createProductData('assets/Suvs/rolls-royce-cullinan.png', 'Rolls Royce Cullinan', 2020, 'White', '4 695 000', 9, 'SUV BILAR');
            $this->createProductData('assets/Suvs/Kia sportage.png', 'Kia Sportage', 2024, 'Green', '402 000', 5, 'SUV BILAR');
            $this->createProductData('assets/Suvs/Jeep Wrangler.png', 'Jeep Wrangler', 2024, 'Green', '901 000', 7, 'SUV BILAR');



            $data = true;
        }

        function createTablesIfNotExists(){

            static $initialized = false;
            if($initialized) return;

            $sql = "CREATE TABLE IF NOT EXISTS `Category` (
                `id` INT AUTO_INCREMENT NOT NULL,
                `name` VARCHAR(50) NOT NULL,
                PRIMARY KEY (`id`) 
            )";
             
             $this->pdo->exec($sql);
            if(!$this->getCategoryByName("SPORT BILAR")){
                $this->addCategories("SPORT BILAR");
            } 

            if(!$this->getCategoryByName("SUV BILAR")){
                $this->addCategories("SUV BILAR");
            }

            $sql = "CREATE TABLE IF NOT EXISTS `Products` (
                `id` INT AUTO_INCREMENT NOT NULL,
                `img` VARCHAR(500) NOT NULL,
                `title` VARCHAR(50) NOT NULL,
                `model` INT NOT NULL,
                `color` VARCHAR(25) NOT NULL,
                `price` VARCHAR(25) NOT NULL,
                `populary` INT NOT NULL,
                `categoryId` INT NOT NULL,
                PRIMARY KEY (`Id`),
                FOREIGN KEY (`categoryId`)
                REFERENCES Category(id)
            )";
    
    $this->pdo->exec($sql);


    $this->usersDatabase->setupUsers();
    $this->usersDatabase->seedUsers();

    $initialized = true;
}    
}
?>