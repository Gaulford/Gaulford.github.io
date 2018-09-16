import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class HeaderComponent extends Vue
{
    @Prop() private msg!: string;
}
