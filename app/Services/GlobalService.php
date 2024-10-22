<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Produto\ProdutoAtividade;

/**
 * Uma especie de classe facade com todas as procedures necessária para o sistema
 *
 * @author Alberto Barella Junior <alberto@abjinfo.com.br>
 */
class GlobalService {


    public static  function populaTabelas(){

        $result = "";
        $dbh = DB::connection()->getPdo();

        $sql = "SELECT
        '<x-adminlte-button id=''buscarInsumo''
            data-toggle=''modal''
            class=''btn btn-xs btn-default text-primary mx-1 shadow''
            title=''Edit''
            data-target=''#modalMin''
            data-id='''+convert(varchar(300),prod_codigo)+'''
            data-descr='''+convert(varchar(300),prod_descricao)+'''>
            <i class=''fas fa-pen''></i>
            </x-adminlte-button>'
            insumos,
            Prod_Codigo,
            Prod_Descricao
            FROM vendasPelicano.dbo.T0250_PRODUTO WHERE prod_ativo = 'A' order by Prod_Descricao";

        $sth = $dbh->prepare($sql);
        $sth->execute();
        $obj = $sth->fetchObject();

        if (!is_null($obj)) {
            $result = DB::select($sql);
        }

        $result = array_map(function ($value){
            return (array)$value;
        },$result);
        //dd($result);
        return $result;


    }

    public static  function populaTabelasCombo(){

        $result = "";
        $dbh = DB::connection()->getPdo();

        $sql = "SELECT
            Prod_Codigo,
            Prod_Descricao
            FROM vendasPelicano.dbo.T0250_PRODUTO WHERE prod_ativo = 'A' order by Prod_Descricao";

        $sth = $dbh->prepare($sql);
        $sth->execute();
        $obj = $sth->fetchObject();

        if (!is_null($obj)) {
            $result = DB::select($sql);
        }

        $result = array_map(function ($value){
            return (array)$value;
        },$result);
        //dd($result);
        return $result;
    }


    public static  function retornaUsuariosCadastrados(){

        $result = "";
        $dbh = DB::connection()->getPdo();

        $sql = "set nocount on;EXEC [PORTAL_CORPORATIVO].[dbo].[sp_Permissao_Usuario] 'alberto.j-basis'";

        $sth = $dbh->prepare($sql);
        $sth->execute();
        $obj = $sth->fetchObject();

        if (!is_null($obj)) {
            $result = DB::select($sql);
        }

        $result = array_map(function ($value){
            return (array)$value;
        },$result);
        //dd($result);
        return $result;


    }


    public static  function populaInsumos(){
        $result = "";
        $dbh = DB::connection()->getPdo();

        $sql = "select  codigo [Código], descricao [Descrição], UN [UN]
                from IPEN.dbo.dicionar
                where prod_a_oid = 1010663
                order by  descricao";

                $sth = $dbh->prepare($sql);
                $sth->execute();
                $obj = $sth->fetchObject();

                if (!is_null($obj)) {
                    $result = DB::select($sql);
                }

                $result = array_map(function ($value){
                    return (array)$value;
                },$result);
                //dd($result);
                return $result;
    }

    public static  function populaInsumosCombo(){
        $result = "";
        $dbh = DB::connection()->getPdo();

        $sql = "select  codigo, descricao
                from IPEN.dbo.dicionar
                where prod_a_oid = 1010663
                order by  descricao";

                $sth = $dbh->prepare($sql);
                $sth->execute();
                $obj = $sth->fetchObject();

                if (!is_null($obj)) {
                    $result = DB::select($sql);
                }

                $result = array_map(function ($value){
                    return (array)$value;
                },$result);
                //dd($result);
                return $result;
    }

    public static  function populaInsumosItem($id){
        $result = "";
        $dbh = DB::connection()->getPdo();
        $sql = "select ficha.*, tipo.Descricao tipo_item, tipo.Oid tipo_itemoid, dici.un
                from spedfiscal..spedr0210      ficha
                inner join ipen..dicionar       dici    on ficha.Cod_Item_oid    = dici.DICIONAR_OID
                inner join ipen..Prodipen       prod    on dici.prodipen_oid     = prod.prodipen_oid
                left join ipen..TipoItemSped    tipo    on ficha.TipoItemSped_Oid = tipo.Oid
                where ficha.cod_produto_oid = ".$id."
                order by ficha.desc_item_comp";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $obj = $sth->fetchObject();

        if (!is_null($obj)) {
            $result = DB::select($sql);
        }

        $result = array_map(function ($value){
            return (array)$value;
        },$result);
        //dd($result);
        return $result;

    }



    public static  function gravaInsumosItem($request){
        //dd($request);

        /*
        CREATE TABLE [dbo].[SpedR0210](
            [R0210_oid] [int] IDENTITY(1,1) NOT NULL,
            [Cod_Produto_oid] [int] NULL,
            [Cod_Item_oidCod] [varchar](50) NULL,
            [Cod_Item_oid] [int] NULL,
            [Cod_Item_Comp] [varchar](60) NULL,
            [Desc_Item_Comp] [varchar](250) NULL,
            [TipoItemSped_oid] [int] NULL,
            [Qtd_Comp] [numeric](18, 2) NULL,
            [Perda] [numeric](18, 2) NULL,
            [Dt_Insert] [datetime] NULL,
            [User_Insert] [varchar](50) NULL,
            [Dt_Update] [datetime] NULL,
            [User_Update] [varchar](50) NULL,
        CONSTRAINT [PK_TSPED_R0210] PRIMARY KEY CLUSTERED
        (
            [R0210_oid] ASC
        )WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
        ) ON [PRIMARY]
        GO
        */


        Log::warning($request). "teste";
        $dbh = DB::connection()->getPdo();

        if ($request->qtde=="0" && $request->perda=="0" && $request->salvar == "Atualizar"){
            //Log::warning("fazer delete " .$request->hd_codi);
            $sql = "delete [spedfiscal].[dbo].[SpedR0210] where R0210_oid = '" . $request->hd_codi ."'";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            //Log::warning($sql);
            return;
        }


        if ($request->salvar == "Gravar"){
            Log::warning("fazer insert");
            $sql = "[spedfiscal].[dbo].[SpedR0210]";
            $sql = "";
            $sql .= "insert into [spedfiscal].[dbo].[SpedR0210] ";
            //$sql .= "insert into [spedfiscal].[dbo].[tb_teste] "; // somente para teste
            $sql .= "( ";
            $sql .= "cod_produto_oid,  ";
            $sql .= "cod_item_oidcod,  ";
            $sql .= "cod_item_oid,  ";
            $sql .= "Cod_Item_Comp,  ";
            $sql .= "Desc_Item_Comp,  ";
            $sql .= "TipoItemSped_Oid,  ";
            $sql .= "Qtd_Comp,  ";
            $sql .= "Perda, ";
            $sql .= "Dt_Insert, ";
            $sql .= "User_Insert, ";
            $sql .= "Dt_Update, ";
            $sql .= "User_Update ";
            $sql .= ") ";
            $sql .= "values ";
            $sql .= "( ";
            $sql .= " '" . $request->idcat . "', ";
            $sql .= " REPLACE(STR((select DICIONAR_OID  from ipen..dicionar  where CODIGO = '" . $request->idinsumo ."'),   10), SPACE(1), '0') , ";
            $sql .= "(select DICIONAR_OID  from ipen..dicionar  where CODIGO = '" . $request->idinsumo ."'),  ";
            $sql .= " '" . $request->idinsumo . "', ";
            //$sql .= "@cod_item_comp,  ";
            $sql .= "(select descricao  from ipen..dicionar  where CODIGO = '" . $request->idinsumo ."'),  ";
            $sql .= "(select spedfiscal.dbo.RetornaTipoitemSpedInsumo('".$request->idinsumo."') codigo),  ";
            $sql .= " '" . $request->qtde . "', ";
            $sql .= " '" . $request->perda . "', ";
            $sql .= "getdate(), ";
            $sql .= " '" . $request->hd_usua . "', ";
            $sql .= "getdate(), ";
            $sql .= " '" . $request->hd_usua . "' ";
            $sql .= ")  ";

            Log::warning($sql);
            $sth = $dbh->prepare($sql);
            $sth->execute();
            return;
        }


        if ($request->salvar == "Atualizar"){
            // OK
            //Log::warning("fazer update");
            $sql   = " update [spedfiscal].[dbo].[SpedR0210] ";
            $sql  .= " set Qtd_Comp =  " . $request->qtde . ",";
            $sql  .= "     perda    =  " . $request->perda . ",";
            $sql  .= "     Dt_Update =  getdate() ,";
            $sql  .= "     User_Update =  '" . $request->hd_usua . "'";
            $sql  .= " where R0210_oid = " . $request->hd_codi;
            $sth = $dbh->prepare($sql);
            $sth->execute();
            return;
        }



    }

}
