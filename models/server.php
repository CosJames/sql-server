<?php
    class Server {
        public function validateAPI()
        {
            $PDO = new CreatonPDO();

            if(isset($_POST['APIKEY']))
            {
                $data = $PDO->manual_fetch( 'Server', '');
                $rowCount = $data->rowCount();
    
                if($rowCount > 0)
                {
                    while($row = $data->fetch(PDO::FETCH_ASSOC))
                    {
                        if($row['APIKEY'] === $_POST['APIKEY'])
                        {
                            return true;
                        }
                    }
                } 
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }

        }
    }