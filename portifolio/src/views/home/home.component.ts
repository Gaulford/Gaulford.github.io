import { Component, Vue } from 'vue-property-decorator';
import HeaderComponent from "@/components/header/header.component.vue";

@Component({
    components: {
        HeaderComponent
    },
})
export default class HomeView extends Vue
{
    constructor()
    {
        super();
    }
}
