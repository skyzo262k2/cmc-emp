<?php
class Pagination
{
    public function Pagination_Btn($tab, $page)
    {
        $len = count($tab);
        $nb = $len / 25;
        $inputs = [];
        for ($i = 1; $i < $nb + 1; $i++) {
            if ($page == $i)
                $inputs[] = "<a href='?get=$i' class='text-dark text-decoration-none'><button class='btn btn-info pag'>$i</button></a>";
            else
                $inputs[] = "<a href='?get=$i' class='text-decoration-none'><button class='btn btn-primary pag'>$i</button></a>";
        }
        return $inputs;
    }

    public function GetTablePage($tab, $nb,$pg='')
    {
        if ($tab) {
            $n = $nb * 25;
            $key = key($tab[0]);
            for ($i = $n - 25; $i < $n; $i++) {
                echo "<tr ondblclick='aff(this)'>";
                if ($i >= count($tab)) {
                    break;
                };
                foreach ($tab[$i] as $col) {
                    echo "<td>" . $col . "</td>";
                }

                if($pg=='formateur'){
                    echo "<td>
                            <form action='' method='POST'>
                                <button  type='submit' name='Reinitialiser' value='".$tab[$i][$key]."'>Réinitialiser</button>
                            </form>
                        </td>";
                }

                echo '<td>
                <form action="" method="POST">
                <button class="sup" type=' . 'submit' . ' name=' . 'sup' . ' value="' . $tab[$i][$key] . '" ><img src="../Images/Icon_Delete.png" width="30px" /></button>
                </form></td>';
                echo " </tr>";
            }
        }
    }

    public function GetTablePage_export($tab, $nb)
    {
        if ($tab) {
            $n = $nb * 25;
            $key = key($tab[0]);
            for ($i = $n - 25; $i < $n; $i++) {
                if ($i >= count($tab)) {
                    break;
                };
                foreach ($tab[$i] as $col) {
                    echo "<td>" . $col . "</td>";
                }
                echo " </tr>";
            }
        }
    }

    public function Pagination_Nb($tab, $nb_page)
    {
        $tab3 = array_slice($tab, 0, 3);
        $nb = 0;
        // echo "<b class='text-info'>Pages </b>";
        if ($nb_page == 1) {

            for ($i = 0; $i < 3; $i++) {
                if (isset($tab3[$i]))
                    echo $tab3[$i];
            }
        }
        if ($nb_page < count($tab) and $nb_page != 1) {
            $nb = 2;
        } elseif ($nb_page != 1) {
            $nb = 3;
        }
        if ($nb != 0) {
            for ($i = 0; $i < $nb + 1; $i++) {
                if (isset($tab[$nb_page - ($nb - $i)])) {
                    $tab3[$i] = $tab[$nb_page - ($nb - $i)];
                    echo $tab3[$i];
                }
            }
        }
    }
}