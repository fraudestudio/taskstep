import { Context } from "./context";
import { Project } from "./project";
import { User } from "./user";
import {Item } from "./item";
import { SideBarComponent } from "./sideBarComponent";

export class FakeDatabase {

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
}