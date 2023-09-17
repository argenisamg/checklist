 <table class="table-check">
        <tr>
            <td><h3>DAY</h3></td>
            <td><h3>PIC</h3></td>
            <td><h3>SHIFT</h3></td>
        </tr>
        <tr>
            <td>                
                <input type="text" name="DAY_INSERT" id='DAY_INSERT' value="<?php  echo $theDay; ?>" size="15s" readonly >
            </td>
            <td>
                <input type="text" name="PIC" id="PIC" value="<?php echo $nombre; ?>" readonly required />
            </td>
            <td>
                <input type="text" name="shift" id="Turno" value="<?php echo $shiftIs; ?>" readonly required />
                <!-- <select input name="shift" id="Turno" required>
                    <option> </option>
                    <option>1st</option>
                    <option>2nd</option>
                    <option>3rd</option>
                    <option>4th</option>
                    <option>5th</option>
                </select> -->
            </td>
        </tr>
</table>