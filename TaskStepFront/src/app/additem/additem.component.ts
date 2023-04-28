import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { FakeDatabase } from '../model/FakeDatabase';
import { Item } from "src/app/model/item";
import { Context } from "src/app/model/context";
import { Project } from "src/app/model/project";
import { ContextService } from "src/service/context-service"
import { ProjectService } from "src/service/project-service"
import { SideBarComponent } from '../model/sideBarComponent';
import { HttpClient } from '@angular/common/http';

@Component({
    selector: 'app-additem',
    templateUrl : 'additem.component.html'
})

export class AdditemComponent implements OnInit {
    
    constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){    
        this.contextService = new ContextService(httpClient)
        this.projectService = new ProjectService(httpClient)
    }


    private dataIsLoad : boolean[] = [
        false,
        false
    ]


    isDataIsLoad() : boolean{
        return this.dataIsLoad[0] && this.dataIsLoad[1];
    }

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

    edit: boolean = false;

    private contextService : ContextService;
    private projectService : ProjectService;

    private contexts : Context[] = [];
    private projects : Project[] = [];

    private sections : SideBarComponent[] = FakeDatabase.GetSideBar();

    /**
    * Information of the form
    */
    form : any  = {
        title : null,
        note : null,
        section : this.sections[0],
        context : null,
        project : null,
        dueDate : null,
        url : null
  
    };

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

    
    editContext(){
        console.log(this.form.context);
        this.router.navigate(["editcontext"], {state : {data : this.form.context.Id}});
    }
    
    editProject(){
        this.router.navigate(['editproject']);
    }
   
    submit() {
        if(this.edit == false){
        let item = new Item(0,this.form.title, this.form.note, this.form.context, this.form.project, this.form.dueDate, this.form.url,this.form.section);
        console.log(item);
        FakeDatabase.AddItem(item);
        }
        else{
            throw new Error("Not implemented yet");
        }
    }
         
}

    


