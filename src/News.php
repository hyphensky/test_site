<?php
class News
{
  public function getNews($pdo, $limit = null) : array
  {
    $sql = "SELECT  id, title, `description`, `datetime`
            FROM News
            ORDER BY id DESC";
    if ($limit != null) {
      $sql.=" LIMIT $limit";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}