<form action="/user/update?id=<?= $file->id ?>" method="post">
  <input type="text" name="filename" value="<?= $file->name ?>" />
  <input type="submit" />
  <a class="glyphicon glyphicon-trash" href="/user/delFile?id=<?= $file->id ?>"></a>
  <a class="glyphicon glyphicon-download-alt" href="<?= $file->path?>" download="<?= pathinfo("$file->path", PATHINFO_BASENAME);?>"></a>
</form>
