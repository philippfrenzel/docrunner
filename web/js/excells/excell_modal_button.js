function eXcell_modalbutton(cell){                                    //excell name is defined here
    if (cell){                                                     //default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function(){}                                //read-only cell doesn't have edit method
    this.isDisabled = function(){ return true; }      // the cell is read-only, that's why it is always in the disabled state
    this.setValue=function(val){
        var row_id=this.cell.parentNode.idd;
        this.setCValue("<a id='win_"+row_id+"' class='btn btn-info' href='#' onclick='dhtmlxContactModal(\""+val+"\");'><i class='glyphicon glyphicon-pencil'></i></a>",val);                                      
    }
}
eXcell_modalbutton.prototype = new eXcell;    // nest all other methods from base class

function eXcell_modaldeletebutton(cell){                                    //excell name is defined here
    if (cell){                                                     //default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function(){}                                //read-only cell doesn't have edit method
    this.isDisabled = function(){ return true; }      // the cell is read-only, that's why it is always in the disabled state
    this.setValue=function(val){
        var row_id=this.cell.parentNode.idd;
        this.setCValue("<a id='win_"+row_id+"' class='btn btn-danger' href='#' onclick='dhtmlxContactModal(\""+val+"\");'><i class='glyphicon glyphicon-trash'></i></a> ",val);                                      
    }
}
eXcell_modaldeletebutton.prototype = new eXcell;    // nest all other methods from base class

function eXcell_modalapprove(cell){                                    //excell name is defined here
    if (cell){                                                     //default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function(){}                                //read-only cell doesn't have edit method
    this.isDisabled = function(){ return true; }      // the cell is read-only, that's why it is always in the disabled state
    this.setValue=function(val){
        var row_id=this.cell.parentNode.idd;
        this.setCValue("<a id='win_"+row_id+"' class='btn btn-success' href='#' onclick='dhtmlxButtonClick(\""+val+"\");'><i class='glyphicon glyphicon-ok'></i></a>",val);                                      
    }
}
eXcell_modalapprove.prototype = new eXcell;    // nest all other methods from base class

function eXcell_modalreject(cell){                                    //excell name is defined here
    if (cell){                                                     //default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function(){}                                //read-only cell doesn't have edit method
    this.isDisabled = function(){ return true; }      // the cell is read-only, that's why it is always in the disabled state
    this.setValue=function(val){
        var row_id=this.cell.parentNode.idd;
        this.setCValue("<a id='win_"+row_id+"' class='btn btn-warning' href='#' onclick='dhtmlxButtonClick(\""+val+"\");'><i class='glyphicon glyphicon-ban-circle'></i></a>",val);                                      
    }
}
eXcell_modalreject.prototype = new eXcell;    // nest all other methods from base class

function eXcell_modalpurchase(cell){                                    //excell name is defined here
    if (cell){                                                     //default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function(){}                                //read-only cell doesn't have edit method
    this.isDisabled = function(){ return true; }      // the cell is read-only, that's why it is always in the disabled state
    this.setValue=function(val){
        var row_id=this.cell.parentNode.idd;
        this.setCValue("<a id='win_"+row_id+"' class='btn btn-success' href='#' onclick='dhtmlxButtonClick(\""+val+"\");'><i class='glyphicon glyphicon-euro'></i></a>",val);                                      
    }
}
eXcell_modalpurchase.prototype = new eXcell;    // nest all other methods from base class
