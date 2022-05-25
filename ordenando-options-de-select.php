<div class="formItem">
        <?php
        /* Reoder options in alphabetical */
        //criando o array com as opcoes
        $opt = array("","","","","","","","","","","","","",""); //coloacar as opcoes dentro do array
        //ordenando o array (numericamente ou alfabeticamente, em ordem crescente)
        sort($opt);
        ?>
            <label for="setor">Setor</label><br>
            <select id="setor" name="setor">
                <option value=""><?php echo $opt[0]?></option>
                <option value=""><?php echo $opt[1]?></option>
                <option value=""><?php echo $opt[2]?></option>
                <option value=""><?php echo $opt[3]?></option>
                <option value=""><?php echo $opt[4]?></option>
                <option value=""><?php echo $opt[5]?></option>
                <option value=""><?php echo $opt[6]?></option>
                <option value=""><?php echo $opt[7]?></option>
                <option value=""><?php echo $opt[8]?></option>
                <option value=""><?php echo $opt[9]?></option>
                <option value=""><?php echo $opt[10]?></option>
                <option value=""><?php echo $opt[11]?></option>
                <option value=""><?php echo $opt[12]?></option>
                <option value=""><?php echo $opt[13]?></option>
            </select>
</div>