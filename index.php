<!--Felix.C Code-->
<!--Simple home page using the bootstrap template https://getbootstrap.com/docs/5.1/examples/carousel/ -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="media/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<title><?php if(isset($title)){echo $title;} else {echo "Smart Home";} ?></title></head>
<?php
$navigation = <<<END
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav me-auto mb-2 mb-md-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Home</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item dyncont">				
                              <a class="btn btn-light" href="login.php">Login</a>
    			            </li>	
                    	
                        </ul>
                    </div>
                </div>
            </nav>
END;
$content = <<<END
<h1 class="mt-5">Welcome to your Smart Home</h1>
END;
echo $navigation;
echo $content;
?>