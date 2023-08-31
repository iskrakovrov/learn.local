<main class="container-fluid ">

    <div class="row text-center">
        <h2>Banhammer</h2>
    </div>
    <div class="col align-center">

        <div class="row justify-content-center">
            <div class="col-6 text-center">


                <div class="alert alert-info" role="alert">
                    Banhammer
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-2 text-center">
                <form method="post" onSubmit="return Complete();">

                    <!-- Note the missing multiple attribute! -->
                    <label for="bhp">Выбор жалобы для поста</label>
                    <select multiple class="form-control" id="bhp" name='bhp[]' size="20">
                        <optgroup label="Nudity|Изображение обнаженного тела">
                            <option value="Nudity|Adult nudity">Adult nudity</option>
                            <option value="Nudity|Sexually suggestive">Sexually suggestive</option>
                            <option value="Nudity|Sexual activity">Sexual activity</option>
                            <option value="Nudity|Sexual exploitation">Sexual exploitation</option>
                            <option value="Nudity|Sexual services">Sexual services</option>
                            <option value="Nudity|Involves a child">Involves a child</option>
                            <option value="Nudity|Sharing private images">Sharing private images</option>
                        </optgroup>

                        <optgroup label="Unauthorized sales|Несанкционированная торговля">
                            <option value="Unauthorized sales|Drugs">Drugs</option>
                            <option value="Unauthorized sales|Weapons">Weapons</option>
                            <option value="Unauthorized sales|Endangered animals">Endangered animals</option>
                            <option value="Unauthorized sales|Other animals">Other animals</option>
                            <option value="Unauthorized sales|Something else">Something else</option>

                        </optgroup>
                        <option value="Spam|"><b>Спам</b></option>

                        <optgroup label="Violence|Насилие">
                            <option value="Violence|Graphic violence">Graphic violence</option>
                            <option value="Violence|Death or severe injury">Death or severe injury</option>
                            <option value="Violence|Violent threat">Violent threat</option>
                            <option value="Violence|Animal abuse">Animal abuse</option>
                            <option value="Violence|Sexual violence">Sexual violence</option>
                            <option value="Violence|Something Else">Something Else</option>
                        </optgroup>
                        <option value="Terrorism|"><b>Терроризм</b></option>
                        <optgroup label="Hate speech|Враждебные высказывания">
                            <option value="Hate speech|Race or ethnicity">Race or ethnicity</option>
                            <option value="Hate speech|National origin">National origin</option>
                            <option value="Hate speech|Religious affiliation">Religious affiliation</option>
                            <option value="Hate speech|Social caste">Social caste</option>
                            <option value="Hate speech|Sexual orientation">Sexual orientation</option>
                            <option value="Hate speech|Sex or gender identity">Sex or gender identity</option>
                            <option value="Hate speech|Disability or disease">Disability or disease</option>
                            <option value="Hate speech|Something else">Something else</option>
                        </optgroup>

                        <optgroup label="False information">
                            <option value="False information|Health">Health</option>
                            <option value="False information|Politics">Politics</option>
                            <option value="False information|Social issue">Social issue</option>
                            <option value="False information|Something else">Something else</option>


                        </optgroup>


                        <optgroup label="Harassment|Преследование">
                            <option value="Harassment|Me">Me</option>
                        </optgroup>


                    </select>


                    <br>

                    <button class="btn btn-secondary" name="add_task" id="add_task" value="banhammer">ACTIVATE
                    </button>


                </form>
            </div>
        </div>
    </div>

</main>