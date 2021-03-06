<div class='col-md-9'>
    <div class='profile-item'>
        <div class="row">
            <div class="col-md-6">
                <h4>Top Rated Knows</h4>
            </div>
            <div class="col-md-6">
                <?php
                $form_option = array('id' => 'rating25_search');
                echo form_open('dashboard/top_rated_knows', $form_option); ?>
                <div class="top-search">
                    <div class="top-search-inner">
                        <div class="easy-autocomplete" style="width: 183px;">
                            <input type="text" name='name_profession' id="name_profession" placeholder="Name or Profession" autocomplete="off"
                            value="<?php echo $name_profession;?>">
                            <div class="easy-autocomplete-container" id="eac-container-gskey">
                                <ul style="display: none;"></ul>
                            </div>
                        </div>
                        <div class="easy-autocomplete" style="width: 183px;">
                            <input type="text" name="search_email" id="search_email" placeholder="Email" autocomplete="off"
                                   value="<?php echo $search_email;?>">
                            <div class="easy-autocomplete-container" id="eac-container-gscityorzip">
                                <ul></ul>
                            </div>
                        </div>
                    </div>

                    <button type='submit' name='btn-toprate-search' value='btn-toprate-search' class="btn-top-rate-search"><i class="fa fa-search"></i></button>

                    <div class="clearer"></div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>


        <div class='hr-sm '></div>
        <?php
        $html = "<table class='table table-responsive'>";
        $html .= "<tr ><th>Name</th><th>Profession</th><th>Email</th><th>Is invited?</th><th>Know Rating</th><th></th></tr>";
        foreach ($rated_knows['results']->result() as $item) {
            $html .= "<tr  >" .
                "<td>" . $item->client_name . "</td>" .
                "<td>" . $item->client_profession . "</td>" .
                "<td>" . $item->client_email . "</td>" .
                "<td>" . ($item->isinvited == '1' ? '<span class="badge badge-red">Invited' : '<span class="badge">No Invited yet') . "</span></td>" .
                "<td>" . $item->rate . "</td>" .
                "<td><a href='" . $base . "dashboard/top-rated-knows/invite/" . $offset . "/" . $item->id . "'  class='btn btn-primary btn-xs '>Sent Invitation</a></td>" .
                "</tr>";
        }
        $html .= "</table>";
        if (isset($links)) echo "<div style='text-align: center;'>" . $links . "</div>";
        echo $html;
        if (isset($links)) echo "<div style='text-align: center;'>" . $links . "</div>";

        ?>

    </div>
    <?php
    if ($editor)
        echo form_open('dashboard/top-rated-knows/' . $offset);

    { ?>
        <div class="modal fade " id="composeinvitemail" tabindex="-1" role="dialog" aria-labelledby="composeinvitemail">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Compose Email</h4>
                    </div>
                    <div class="modal-body text-left mailpreview">
                        <div class='row'>
                            <div class='col-md-5'>
                                <h3>Know Profile</h3>
                                <div id='knowprofilesummary' class='globalsearch'>
                                    <?php
                                    if ($know_info != null) {
                                        $know_det = $know_info->row();
                                        echo '<p><strong>' . $know_det->client_name . '</strong></p> ';
                                        echo '<p><strong>' . $know_det->client_email . '</strong></p> ';
                                        echo '<p><strong>Vocation</strong><br/>' . $know_det->client_profession . '</p>';
                                        $token = md5($know_det->id);
                                        $tokenlength = strlen($know_det->id);
                                        $token = $know_det->id . $token;
                                        $mailbody = str_replace("{receipent}", $know_det->client_name, $mailbody);
                                        $mailbody = str_replace("{tokenid}", $token, $mailbody);
                                        $mailbody = str_replace("{tokenlength}", $tokenlength, $mailbody);
                                        $mailbody = str_replace("{tokenlengthhash}", md5($tokenlength), $mailbody);
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class='col-md-7'>
                                <h3>Compose Email</h3>
                                <label>Subject:</label>
                                <input class="form-control knowinvitemailsubject" id='knowinvitemailsubject' placeholder="Subject" value='Claim your MyCity.com Profile'>
                                <br/>
                                <label>Compose Email:</label>

                                <textarea name="knowinviteemail" id="knowinviteemail"><?php echo $mailbody; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <input type='hidden' name='knowid' value='<?php echo $knowid; ?>'/>
                        <button type='submit' name='btn_send_email' value='send' class="btn btn-success" id="btnsendclaimprofile">Send</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    <?php } ?>

</div>
</div> <!-- row -->
</div> <!-- container -->
<style>
    .profile-item .top-search {
        border: solid 1px #d7d3d380;
        margin: 10px;
    }

    .btn-top-rate-search {
        border: none;
        margin-top: -4px;
        float: right;
        margin-right: 5px;
        background-color: #fff;
    }
</style>