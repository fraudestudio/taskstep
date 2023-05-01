import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { FakeDatabase } from '../model/FakeDatabase';
import { Item } from "src/app/model/item";
import { Context } from "src/app/model/context";
import { Project } from "src/app/model/project";
import { ContextService } from "src/service/context-service"
import { ProjectService } from "src/service/project-service"
import { ItemService } from "src/service/item-service"
import { SideBarComponent } from '../model/sideBarComponent';
import { HttpClient } from '@angular/common/http';

@Component({
    selector: 'app-additem',
    templateUrl : 'additem.component.html'
})

export class AdditemComponent implements OnInit {
    
    /**
     * Init the service 
     * Init the form information if there is an item to edit
     */
    constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){    
        this.contextService = new ContextService(httpClient, router);
        this.projectService = new ProjectService(httpClient, router);
        this.itemService = new ItemService(httpClient, router);
        this.sections = FakeDatabase.GetSideBar();
        this.form.section = this.sections[0].Database;

        if (history.state.data?.item){
            this.edit = true;
            this.form.title = history.state.data?.item.Title;
            if (history.state.data?.item.Notes) {
                this.form.note = history.state.data?.item.Notes;
            }
            else {
                this.form.note = "";
            }
            switch(history.state.data?.item.Section){
                case "ideas": this.form.section = this.sections[0].Database; break;
                case "tobuy": this.form.section = this.sections[1].Database; break;
                case "immediate": this.form.section = this.sections[2].Database; break;
                case "week": this.form.section = this.sections[3].Database; break;
                case "month": this.form.section = this.sections[4].Database; break;
                case "year": this.form.section = this.sections[5].Database; break;
                case "lifetime": this.form.section = this.sections[6].Database; break;
            }
            this.form.context = history.state.data?.item.Context.Id;
            this.form.project = history.state.data?.item.Project.Id;
            this.form.dueDate = history.state.data?.item.Date;
            if (history.state.data?.item.Url) {
                this.form.url = history.state.data?.item.Url;
            }
            else {
                this.form.url = "";
            }
        }
        else {
            this.edit = false;
        }
    }

    /**
     * Init data
     */
    ngOnInit(): void {
        this.contextService.getContexts().subscribe((projects) => { 
            this.contexts = projects;
            this.dataIsLoad[0] = true;
        });
        this.projectService.getProjects().subscribe((projects) => {
            this.projects = projects
            this.dataIsLoad[1] = true;
        });
    }

    /**
     * Tells if the page is in edit mode
     */
    private edit: boolean;

    get Edit() : boolean{
        return this.edit;
    }

    /**
     * Communication with the API for the context thanks to the context service
     */
    private contextService : ContextService;
    
    /**
     * Communication with the API for the project thanks to the context service
     */
    private projectService : ProjectService;
    
    /**
     * Communication with the API for the item thanks to the context service
     */
    private itemService : ItemService;

    /**
     * Context to display
     */
    private contexts : Context[] = [];
    /**
     * Project to display
     */
    private projects : Project[] = [];

    /**
     * Sections to display
     */
    private sections : SideBarComponent[];

    /**
     * Store the loaded data
     */
    private dataIsLoad : boolean[] = [
        false,
        false
    ]


    /**
    * Information of the form
    */
    form : any  = {
        title : null,
        note : "",
        section : null,
        context : null,
        project : null,
        dueDate : null,
        url : ""
  
    };

    /**
     * Message to display if there is any
     */
    get message() : string {
        return history.state.data?.message; 
    }
    
    /**
     * Type of the message to display if there is any
     */
    get type() : string {
      return history.state.data?.type;
    }

    /**
     * Check if all the data is loaded
     * @returns the result of the verification
     */
    isDataIsLoad() : boolean{
        return this.dataIsLoad[0] && this.dataIsLoad[1];
    }

    /**
     * method that returns the section 
     * @param id the id of the section
     * @returns the name of the section
     */
    protected Section(id :number) : string {
        return this.sections[id].toString();   
    }

    /**
     * Property that returns the sections
     * @returns the sections
     */
    get Sections() : SideBarComponent[] { return this.sections;  }

    get Contexts() : Context[] {  return this.contexts }

    get Projects() : Project[] {  return this.projects }

    
    /**
     * edit the selected context
     */
    editContext(){
        this.router.navigate(["editcontext"], {state : {data : Number(this.form.context)}});
    }
    
    /**
     * Edit the selected project
     */
    editProject(){
        this.router.navigate(["editproject"], {state : {data : Number(this.form.project)}});
    }
   
    /**
     * If in edit mode, send the changes with given information
     * If not, add item with the given information
     */
    submit() {
        if(this.edit == false){
            let item = new Item(false, 0 ,this.form.title, this.form.note, new Context("",Number(this.form.context)), new Project("",Number(this.form.project)), this.form.dueDate, this.form.url,this.form.section);
            this.itemService.addItem(item).subscribe((data) =>{
                // Force reload of the page
                this.router.routeReuseStrategy.shouldReuseRoute = () => false;
                this.router.onSameUrlNavigation = 'reload';
                if (data){
                    this.router.navigateByUrl('/additem', {state : {data : {message : "Votre tâches a bien été ajoutée !", type : "confirmation"}}});
                }
                else {
                    this.router.navigateByUrl('/additem', {state : {data : {message : "Une erreur est survenue", type : "warning"}}});
                }

            })
        }
        else {
            let item = new Item(false,history.state.data?.item.Id,this.form.title, this.form.note, new Context("",Number(this.form.context)), new Project("",Number(this.form.project)), this.form.dueDate, this.form.url,this.form.section);
            this.itemService.modifyItem(item).subscribe((data) =>{
                // Force reload of the page
                this.router.routeReuseStrategy.shouldReuseRoute = () => false;
                this.router.onSameUrlNavigation = 'reload';
                if (!data){
                    this.router.navigateByUrl('/additem', {state : {data : {message : "Votre tâches a bien été modifiée !", type : "confirmation"}}});
                }
                else {
                    this.router.navigateByUrl('/additem', {state : {data : {message : "Une erreur est survenue", type : "warning"}}});
                }
            })
        }

        FakeDatabase.UpdateSideBar(this.itemService);



    }
         
}

    


