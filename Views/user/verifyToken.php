<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Hohohot</title>
    <link rel="stylesheet" href="../../static/css/token.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <?php if(isset($isValidate) && $isValidate){ ?>
                    <form action="/user/changePassword" method="post">
                        <div class="mb-2">
                            <input class="form-control" type="password" id="password" name="new_password" placeholder="Mot de passe :" required>
                        </div>
                        <div>
                            <input class="form-control" type="password" id="password-confirmation" name="new_password_confirmation" placeholder="Confirmer mot de passe :" required>
                        </div>
                        <div>
                            <input type="submit" name="submitChange" value="Confirmer">
                        </div>
                    </form>
                    <p><?php if(isset($message))echo $message; ?></p>
                    <?php }else { ?>
                <form action="/user/verifyToken" method="post">
                    <input class="form-control" type="text" name="token" placeholder="Entrez le code qui vous a été envoyé" required>
                    <div class="mt-2">
                        <input type="submit" name="submitToken" value="Vérifier">
                    </div>
                </form>
                <div class="mt-1">
                    <p><?php if(isset($message))echo $message; ?></p>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>