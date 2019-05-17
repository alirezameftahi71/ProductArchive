<?php require_once "../../database.php" ?>
<?php
class Product
{
	protected static $table_name = "game";
	public $id;
	public $title;
	public $released_date;
	public $rate;
	public $description;
	public $cover_pic;
	public $completed;
	public $genres;
	public $publishers;
	public $platforms;

	// Common Database Methods
	public static function find_all()
	{
		return self::find_by_sql("SELECT id, title, released_date, rate, description, completed FROM " . self::$table_name);
	}

	public static function find_by_id($id = 0)
	{
		$result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function find_by_sql($sql = "")
	{
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		while ($row = mysqli_fetch_array($result_set)) {
			$object_array[] = self::instantiate($row);
		}
		return $object_array;
	}

	public static function count_all()
	{
		global $database;
		$sql = "SELECT COUNT(id) FROM " . self::$table_name;
		$result_set = $database->query($sql);
		$row = mysqli_fetch_array($result_set);
		return array_shift($row);
	}

	private static function instantiate($record)
	{
		$object = new self;
		$object->id = $record['id'];
		$object->title = $record['title'];
		$object->released_date = $record['released_date'];
		$object->rate = $record['rate'];
		$object->description = $record['description'];
		$object->cover_pic = isset($record['cover_pic']) ? $record['cover_pic'] : null;
		$object->completed = $record['completed'];
		return $object;
	}
}
