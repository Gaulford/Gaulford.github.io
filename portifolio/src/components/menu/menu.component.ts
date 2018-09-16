import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class MenuComponent extends Vue
{
    @Prop() private msg!: string;
}
