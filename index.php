<?php
  if(isset($_POST['button'])){
    $imgUrl = $_POST['imgurl'];
    $ch = curl_init($imgUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $downloadImg = curl_exec($ch);
    curl_close($ch);
    header('Content-type: image/jpg');
    header('Content-Disposition: attachment;filename="Image.jpeg"');
    echo $downloadImg;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>GetUrNeed</title>
  </head>
  <body>
    <header>
      <a href="index.html"><h1>GetUrNeed</h1></a>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </header>
    <div class="form-section">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="input-section">
          <label for="text-input">Paste Your URL</label>
          <input
            type="text"
            id="text-input"
            placeholder="https://www.youtube.com/watch?v=XW1aGkzyjQg"
          />
          <input class="hidden-input" type="hidden" name="imgurl" />
        </div>
        <div class="preview-section">
          <img
            src=""
            alt="preview image"
            class="preview-image"
          />
          <img
            class="icon"
            src="./asset/cloud-arrow-down-solid.svg"
            alt="Font Awesome"
          />
          <span>Paste url to see preview</span>
        </div>
        <button class="btn" type="submit" name="button">Download</button>
      </form>
    </div>
    <script>
      const urlField = document.querySelector("#text-input");
      previewArea = document.querySelector(".preview-section");
      (imgTag = previewArea.querySelector(".preview-image")),
        (hiddenInput = document.querySelector(".hidden-input")),
        (button = document.querySelector(".btn"));

      urlField.onkeyup = () => {
        let imgUrl = urlField.value;
        previewArea.classList.add("active");
        button.style.pointerEvents = "auto";
        
        if (imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1) {
          let vidId = imgUrl.split("v=")[1].substring(0, 11);
          let ytImgUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
          imgTag.src = ytImgUrl;
        } else if (imgUrl.indexOf("https://youtu.be/") != -1) {
          let vidId = imgUrl.split("be/")[1].substring(0, 11);
          let ytImgUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
          imgTag.src = ytImgUrl;
        } else if (imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)) {
          imgTag.src = imgUrl;
        }else if(imgUrl.indexOf("https://www.instagram.com/p/") != -1){
          let vidId = imgUrl.split("p")[1].substring(0, 11);
          let ytImgUrl = `https://www.instagram.com/p/${vidId}/`;
          imgTag.src = ytImgUrl;
        } 
        else {
          imgTag.src = "";
          button.style.pointerEvents = "none";
          previewArea.classList.remove("active");
        }
        hiddenInput.value = imgTag.src;
      };
    </script>
  </body>
</html>
