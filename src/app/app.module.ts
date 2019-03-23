import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { SpotlightComponent } from './components/spotlight/spotlight.component';
import { HomeComponent } from './pages/home/home.component';
import { MenuComponent } from './components/menu/menu.component';
import { DrawerComponent } from './components/drawer/drawer.component';

@NgModule({
    declarations: [
        AppComponent,
        SpotlightComponent,
        HomeComponent,
        MenuComponent,
        DrawerComponent
    ],
    imports: [
        BrowserModule,
        AppRoutingModule
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule
{
}
