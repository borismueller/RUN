<form action="/user/update?id=<?= $file->id ?>" method="post">
  <input type="text" name="filename" value="<?= $file->name ?>" />
  <input type="submit" />
</form>
