import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class PortifolioComponent extends Vue
{
    @Prop() private msg!: string;
}
