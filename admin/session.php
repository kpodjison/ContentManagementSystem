<?php
    session_start();

    // success
    function SuccessMsg()
    {
            if(isset($_SESSION["SuccessMsg"] ))
            {
                $status = '<div class="alert alert-success">'
                            .htmlentities($_SESSION["SuccessMsg"]).
                            '</div>';

                            //make this session null after using it
                            $_SESSION["SuccessMsg"]  = null;
                            return $status;
            }

    }     
    // success message for unexisting approved comments
    function ApSuccessMsg()
    {
            if(isset($_SESSION["ApSuccessMsg"] ))
            {
                $status = '<div class="alert alert-success">'
                            .htmlentities($_SESSION["ApSuccessMsg"]).
                            '</div>';

                            //make this session null after using it
                            $_SESSION["ApSuccessMsg"]  = null;
                            return $status;
            }

    }     
 
    //error
    function ErrorMsg()
    {
        if(isset($_SESSION['ErrorMsg']))
        {
            $status = '<div class="alert alert-danger ">'
                        .htmlentities($_SESSION["ErrorMsg"]).
                        '</div>';

                          //make this session null after using it
                          $_SESSION["ErrorMsg"]  = null;
                          return $status;
        }
    }



?>