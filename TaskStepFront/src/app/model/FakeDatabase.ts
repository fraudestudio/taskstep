import { Context } from "./context";
import { Project } from "./project";
import { User } from "./user";
import {Item } from "./item";
import { SideBarComponent } from "./sideBarComponent";
import { ItemService } from "src/service/item-service";
import { HttpClient } from "@angular/common/http";
import { Router } from "@angular/router";

export class FakeDatabase {

    constructor(private httpClient : HttpClient, private router : Router){
        
    }


    /**
     * All the side bar component
     */
    private static sideBar : SideBarComponent[] = [ 
        new SideBarComponent("lightbulb", "Idées",0,0,"ideas"), 
        new SideBarComponent("cart", "Vous voulez peut être acheter",0,0,"tobuy"), 
        new SideBarComponent("lightning", "Immédiat",0,0,"immediate"),
        new SideBarComponent("newspaper", "Ce week-end",0,0,"week"),
        new SideBarComponent("calendar", "Ce mois-ci",0,0,"month"),
        new SideBarComponent("world", "Cette année",0,0,"year"),
        new SideBarComponent("user", "Peut-être un jour",0,0,"lifetime")
    ];

    /**
     * Get the side bar components
     * @returns the side bar components
     */
    public static GetSideBar() : SideBarComponent[] {
        return this.sideBar;
    }   

    public static UpdateSideBar(itemService : ItemService){
        itemService.getDoneSection().subscribe((data) => 
        {
            this.sideBar[0].Done = data.ideas.done;
            this.sideBar[0].UnDone = data.ideas.undone;
            this.sideBar[1].Done = data.tobuy.done;
            this.sideBar[1].UnDone = data.tobuy.undone;
            this.sideBar[2].Done = data.immediate.done;
            this.sideBar[2].UnDone = data.immediate.undone;
            this.sideBar[3].Done = data.week.done;
            this.sideBar[3].UnDone = data.week.undone;
            this.sideBar[4].Done = data.month.done;
            this.sideBar[4].UnDone = data.month.undone;
            this.sideBar[5].Done = data.year.done;
            this.sideBar[5].UnDone = data.year.undone;
            this.sideBar[6].Done = data.lifetime.done;
            this.sideBar[6].UnDone = data.lifetime.undone;
        });
    }
}