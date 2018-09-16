import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class TeamComponent extends Vue
{
    @Prop() private msg!: string;
}
