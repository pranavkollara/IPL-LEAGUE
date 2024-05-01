<table class="table table-bordered border border-3 rounded mt-4">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Player</th>
            <th scope="col">Team</th>
            <th scope="col">r1</th>
            <th scope="col">w1</th>
            <th scope="col">c1</th>
            <th scope="col">m1</th>
            <th scope="col">r2</th>
            <th scope="col">w2</th>
            <th scope="col">c2</th>
            <th scope="col">m2</th>
            <th scope="col">r3</th>
            <th scope="col">w3</th>
            <th scope="col">c3</th>
            <th scope="col">m3</th>
            <th scope="col">r4</th>
            <th scope="col">w4</th>
            <th scope="col">c4</th>
            <th scope="col">m4</th>
            <th scope="col">r5</th>
            <th scope="col">w5</th>
            <th scope="col">c5</th>
            <th scope="col">m5</th>
            <th scope="col">r6</th>
            <th scope="col">w6</th>
            <th scope="col">c6</th>
            <th scope="col">m6</th>
            <th scope="col">r7</th>
            <th scope="col">w7</th>
            <th scope="col">c7</th>
            <th scope="col">m7</th>

        </tr>
    </thead>
    <?php
    $w = 1;
    require_once "../conn.php";
    $sql_query_team = "SELECT * FROM `player_point_1` WHERE team LIKE '$team_team'";
    if ($team_result = $conn->query($sql_query_team)) {
        while ($row_team = $team_result->fetch_assoc()) {
            $player = $row_team['player'];
            $team = $row_team['team'];
            $r1 = $row_team['r1'];
            $w1 = $row_team['w1'];
            $c1 = $row_team['c1'];
            $m1 = $row_team['m1'];
            $r2 = $row_team['r2'];
            $w2 = $row_team['w2'];
            $c2 = $row_team['c2'];
            $m2 = $row_team['m2'];
            $r3 = $row_team['r3'];
            $w3 = $row_team['w3'];
            $c3 = $row_team['c3'];
            $m3 = $row_team['m3'];
            $r4 = $row_team['r4'];
            $w4 = $row_team['w4'];
            $c4 = $row_team['c4'];
            $m4 = $row_team['m4'];
            $r5 = $row_team['r5'];
            $w5 = $row_team['w5'];
            $c5 = $row_team['c5'];
            $m5 = $row_team['m5'];
            $r6 = $row_team['r6'];
            $w6 = $row_team['w6'];
            $c6 = $row_team['c6'];
            $m6 = $row_team['m6'];
            $r7 = $row_team['r7'];
            $w7 = $row_team['w7'];
            $c7 = $row_team['c7'];
            $m7 = $row_team['m7'];
            ?>

            <tbody>

                <tr>
                    <td>
                        <?php echo $w++; ?>
                    </td>
                    <td>
                        <?php


                        echo $player;

                        ?>
                    </td>
                    <td>
                        <?php echo strtoupper($team); ?>
                    </td>
                    <td>
                        <?php echo $r1; ?>
                    </td>
                    <td>
                        <?php echo $w1; ?>
                    </td>
                    <td>
                        <?php echo $c1; ?>
                    </td>
                    <td>
                        <?php echo $m1; ?>
                    </td>
                    <td>
                        <?php echo $r2; ?>
                    </td>
                    <td>
                        <?php echo $w2; ?>
                    </td>
                    <td>
                        <?php echo $c2; ?>
                    </td>
                    <td>
                        <?php echo $m2; ?>
                    </td>
                    <td>
                        <?php echo $r3; ?>
                    </td>
                    <td>
                        <?php echo $w3; ?>
                    </td>
                    <td>
                        <?php echo $c3; ?>
                    </td>
                    <td>
                        <?php echo $m3; ?>
                    </td>
                    <td>
                        <?php echo $r4; ?>
                    </td>
                    <td>
                        <?php echo $w4; ?>
                    </td>
                    <td>
                        <?php echo $c4; ?>
                    </td>
                    <td>
                        <?php echo $m4; ?>
                    </td>
                    <td>
                        <?php echo $r5; ?>
                    </td>
                    <td>
                        <?php echo $w5; ?>
                    </td>
                    <td>
                        <?php echo $c5; ?>
                    </td>
                    <td>
                        <?php echo $m5; ?>
                    </td>
                    <td>
                        <?php echo $r6; ?>
                    </td>
                    <td>
                        <?php echo $w6; ?>
                    </td>
                    <td>
                        <?php echo $c6; ?>
                    </td>
                    <td>
                        <?php echo $m6; ?>
                    </td>
                    <td>
                        <?php echo $r7; ?>
                    </td>
                    <td>
                        <?php echo $w7; ?>
                    </td>
                    <td>
                        <?php echo $c7; ?>
                    </td>
                    <td>
                        <?php echo $m7; ?>
                    </td>
                </tr>
                <?php
        }
    }
    ?>

    </tbody>
</table>