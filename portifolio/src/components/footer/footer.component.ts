import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class FooterComponent extends Vue
{
    @Prop() private msg!: string;
}
