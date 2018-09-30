import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class HeaderComponent extends Vue
{
    protected toggle: boolean = false;

    constructor()
    {
        super();
    }

    protected onMenuToggle():void
    {
        this.toggle = !this.toggle;
    }
}
