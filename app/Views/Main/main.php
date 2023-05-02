<?php
 $session = session();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schulplanung</title>
    <link rel="stylesheet" href="<?php echo base_url('ci4/public/style_calendar2.css');?>">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
      integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
      crossorigin="anonymous">
    </script>
    
    
    <div class="alert alert-success" role="alert" hidden>Datensatz wurde erfolgreich gelöscht.</div>
    <div class="alert alert-success" role="alert" hidden>Datensatz wurde erfolgreich bearbeitet.</div>
    <!--<div class="alert alert-danger" role="alert">Datensatz wurde erfolgreich erstellt.</div>-->
  </head>
  <body>
    <main>
      <p value="<?php ?>"></p>
      <div class="app">
        <?php echo $this->include('Navbar/navbar.php') ?>
      </div>
      <h1>Schulplanung</h1>
      
      <!-- ------------------------------------ Alerts             -->
      <?php
        if ($session->create_successful == true) {
          ?>
            <div id="post_successful" class="alert_successful alert alert-success" >
              Beitrag wurde erfolgreich erstellt.
            </div>
          <?php
          $session->create_successful = false;
        }
        
        if ($session->delete_successful == true) {
          ?>
            <div id="delete_successful" class="alert_successful alert alert-success" >
              Beitrag wurde erfolgreich gelöscht.
            </div>
          <?php
          $session->delete_successful = false;
        }
        if ($session->edit_successful == true) {
          ?>
            <div id="edit_successful" class="alert_successful alert alert-success" >
              Beitrag wurde erfolgreich bearbeitet.
            </div>
          <?php
          $session->edit_successful = false;
        }
      ?>
      <!-- ------------------------------------ End of Alerts             -->
      <div class="calendar">
        <div class="calendar-header">
            <span class="month-picker" id="month-picker">April</span>
            <div class="year-picker">
                <span class="year-change" id="prev-year">
                    <pre><</pre>
                </span>
                <span id="year">2022</span>
                <span class="year-change" id="next-year">
                    <pre>></pre>
                </span>
            </div>
        </div>
        <div class="calendar-body">
            <div class="calendar-week-day">
                <div>So</div>
                <div>Mo</div>
                <div>Di</div>
                <div>Mi</div>
                <div>Do</div>
                <div>Fr</div>
                <div>Sa</div>
            </div>
            <div class="calendar-days"></div>
        </div>
          <div class="month-list"></div>
        </div>
      <div>
        <form id="date_form" action="get_posts" method="post">
          <input id="datepicker" type="date" hidden name="selected_date" value="<?php echo $session->selected_date ?>" >
          <input type="submit" style="visibility: hidden;"></input>
        </form>
       
          <div class="form_all">
            <div>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Zeit</th>
                    <th scope="col">Eintrag</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                <?php $counter = 1;?>
                  <?php foreach($posts as $posts){
                  ?><tr>
                    <th scope="row"><?php echo $counter ?></th>
                    <td>
                      <div id="time_div" class="time_div">
                        <?php 
                        $time_from_formatted = substr_replace($posts['time_from'], "", -3);
                        $time_to_formatted = substr_replace($posts['time_to'], "", -3);
                        echo $time_from_formatted;
                        echo ' - ';
                        echo $time_to_formatted;?>
                        <input type="time" id="time_from" class="time_from" value="<?php echo $time_from_formatted?>" hidden></input>
                        <input type="time" id="time_to" class="time_to" value="<?php echo $time_to_formatted?>" hidden></input>
                      </div>
                  <form action="edit_post" method="post">
                        <div id="edit_time_div" class="edit_time_div" hidden="hidden">
                          <label>Von <input id="edit_time_from" class="edit_time_from" type="time" name="edit_time_from" value="<?php echo $time_from_formatted?>"required></label>
                          <label>Bis <input id="edit_time_to" class="edit_time_to" type="time" name="edit_time_to" value="<?php echo $time_to_formatted?>" required></label>
                        </div> 
                    </td>
                    <td>
                      <div id="content_div" class="content_div">
                        <?php echo $posts['content']; ?>
                      </div>  
                      <div id ="edit_content_textarea" class="edit_row_<?php echo $counter-1?> 
                      edit_content_textarea edit_content_div" name="edit_content_textarea" hidden >
                        <textarea id="edit_textarea" class="edit_textarea" rows="2" cols="20" name="edit_content" value="<?php echo $posts['content'];?>" 
                          ><?php echo $posts['content'];?>
                        </textarea>
                      </div>
                    </td>
                    <td>
                      <div class="flex-container">
                        <div id="edit_content_btns" class="edit_content_btns edit_content_div flex-child" hidden>
                            <button name="save_edit_btn" class="btn btn-primary btn-margin-top" value="<?php echo $posts['id'];?>">
                              <i id="edit_save" class="fa-solid fa-floppy-disk"></i>
                            </button>
                  </form>
                        </div>
                        <div class="flex-child">
                          <button id="edit_btn" name="edit_btn" class="edit_btn btn btn-primary btn-margin-top"
                            value="<?php echo $posts['id'];?>" >
                            <i id="edit_btn_icn" class="edit_btn_icn fa-solid fa-pen"></i>
                          </button>
                          <div class="cancel_btn" hidden>
                            <button name="cancel_edit_btn" class="btn btn-warning btn-margin-top" >
                              <i id="edit_cancel" class="fa-solid fa-ban"></i>
                            </button>
                          </div>
                        </div>
                        <!--</form> -->
                      </div>
                    </td>
                    <td>
                      <form action="delete_post" method="post"> 
                        <button name="del_btn" class="btn btn-danger btn-margin-top" value="<?php echo $posts['id'];?>"
                          onclick="return confirm('Sind Sie sicher, dass Sie diesen Eintrag löschen wollen?')" type="submit">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </form>  
                    </td>
        
                  </tr>
                  <?php 
                    $counter ++;
                  }?>
                </tbody>
              </table>
            </div>
         
        <form action="create_post" method="post">
            <div id="create_post_div" hidden="hidden">
              <textarea rows="4" cols="50" name="content"></textarea>
              <label>Von <input type="time" name="time_from" required></label>
              <label>Bis <input type="time" name="time_to" required></label>
              <button class="btn btn-success btn-margin-top" type="submit">Hinzufügen</button>
            </div> 
            <button class="btn btn-primary btn-margin-top" type="button" onclick="toggle(this)">Zeit erfassen</button>
            <div class="clearfix"></div>
        </form>
      </div>
  
    </main>
    <script src="<?php echo base_url('ci4/public/calendar.js');?>">
      
    </script>
  </body>
</html>